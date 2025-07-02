<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\Order as OrderModel;
use Illuminate\Support\Facades\Auth;

class PickerOrdersComponent extends Component
{
    public $orders = [];
    public $loading = true;
    public $error = null;
    public $selectedOrder = null;
    public $showModal = false;
    public $scannedBarcode = '';
    public $pickedItems = [];
    public $errorMessage = '';

    public function mount()
    {
        $this->loadPickerOrders();
    }

    protected function getListeners()
    {
        return [
            'refreshOrders' => 'loadPickerOrders',
            '$refresh'
        ];
    }

    public function loadPickerOrders()
    {
        try {
            $this->loading = true;
            $this->orders = OrderModel::where('picker_id', Auth::id())
                ->where('status', 'ready_to_pick')
                ->orderBy('created_at', 'desc')
                ->get()
                ->toArray();
            $this->error = null;
        } catch (\Exception $e) {
            $this->error = "Failed to load orders: " . $e->getMessage();
            \Log::error('Picker orders load failed: ' . $e->getMessage());
        } finally {
            $this->loading = false;
        }
    }

    public function viewOrder($orderId)
    {
        $this->selectedOrder = OrderModel::find($orderId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }

    public function completeOrder($orderId)
    {
        $order = OrderModel::find($orderId);
        
        if ($order->picker_id !== Auth::id()) {
            session()->flash('error', 'You are not authorized to complete this order.');
            return;
        }

        
        $order->update(['status' => 'picked']);
        $this->loadPickerOrders();

        session()->flash('message', 'Order picked successfully!');
        $this->dispatch('orderUpdated');
        $this->closeModal();
    }

    public function startPicking($orderId)
    {
        $this->selectedOrder = OrderModel::find($orderId);
        $this->pickedItems = [];
        $this->showModal = true;
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

        
        if (!isset($this->pickedItems[$item['product_id']])) {
            $this->pickedItems[$item['product_id']] = [
                'name' => $item['name'],
                'ordered_qty' => $item['quantity'],
                'picked_qty' => 0
            ];
        }

        
        if ($this->pickedItems[$item['product_id']]['picked_qty'] < $this->pickedItems[$item['product_id']]['ordered_qty']) {
            $this->pickedItems[$item['product_id']]['picked_qty']++;
            $this->errorMessage = '';
        } else {
            $this->errorMessage = 'All items of this type have been picked!';
        }

        $this->scannedBarcode = '';
    }

    public function allItemsPicked()
    {
        if (empty($this->pickedItems)) {
            return false;
        }

        foreach ($this->selectedOrder->items_with_details as $item) {
            if (!isset($this->pickedItems[$item['product_id']]) || 
                $this->pickedItems[$item['product_id']]['picked_qty'] < $item['quantity']) {
                return false;
            }
        }
        return true;
    }

    public function render()
    {
        return view('livewire.picker-orders-component');
    }
}