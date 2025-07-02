<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\Order as OrderModel;
use Illuminate\Support\Facades\Auth;

class PackerOrdersComponent extends Component
{
    public $orders = [];
    public $loading = true;
    public $error = null;
    public $selectedOrder = null;
    public $showModal = false;
    public $scannedBarcode = '';
    public $packedItems = [];
    public $errorMessage = '';

    public function mount()
    {
        $this->loadPackerOrders();
    }

    protected function getListeners()
    {
        return [
            'refreshOrders' => 'loadPackerOrders',
            '$refresh'
        ];
    }

    public function loadPackerOrders()
    {
        try {
            $this->loading = true;
            $this->orders = OrderModel::where('packer_id', Auth::id())
                ->where('status', 'ready_to_pack')
                ->orderBy('created_at', 'desc')
                ->get()
                ->toArray();
            $this->error = null;
        } catch (\Exception $e) {
            $this->error = "Failed to load orders: " . $e->getMessage();
            \Log::error('Packer orders load failed: ' . $e->getMessage());
        } finally {
            $this->loading = false;
        }
    }

    public function startPacking($orderId)
    {
        $this->selectedOrder = OrderModel::find($orderId);
        $this->packedItems = [];
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }

    public function scanItem()
    {
        if (empty($this->scannedBarcode)) {
            return;
        }

        $orderItems = collect($this->selectedOrder->items_with_details);
        $item = $orderItems->first(function ($item) {
            return isset($item['barcode']) && $item['barcode'] === $this->scannedBarcode;
        });

        if (!$item) {
            $this->errorMessage = 'Item not found in this order!';
            $this->scannedBarcode = '';
            return;
        }

        if (!isset($this->packedItems[$item['product_id']])) {
            $this->packedItems[$item['product_id']] = [
                'name' => $item['name'],
                'ordered_qty' => $item['quantity'],
                'packed_qty' => 0
            ];
        }

        if ($this->packedItems[$item['product_id']]['packed_qty'] < $this->packedItems[$item['product_id']]['ordered_qty']) {
            $this->packedItems[$item['product_id']]['packed_qty']++;
            $this->errorMessage = '';
        } else {
            $this->errorMessage = 'All items of this type have been packed!';
        }

        $this->scannedBarcode = '';
    }

    public function allItemsPacked()
    {
        if (empty($this->packedItems)) {
            return false;
        }

        foreach ($this->selectedOrder->items_with_details as $item) {
            if (!isset($this->packedItems[$item['product_id']]) || 
                $this->packedItems[$item['product_id']]['packed_qty'] < $item['quantity']) {
                return false;
            }
        }
        return true;
    }

    public function completeOrder($orderId)
    {
        $order = OrderModel::find($orderId);
        
        if ($order->packer_id !== Auth::id()) {
            session()->flash('error', 'You are not authorized to complete this order.');
            return;
        }

        $order->update(['status' => 'completed']);
        $this->loadPackerOrders();

        session()->flash('message', 'Order packed and completed successfully!');
        $this->dispatch('orderUpdated');
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.packer-orders-component');
    }
}