<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;  // Changed from OrderModel
use App\Models\AdminUser;
use Illuminate\Support\Facades\Http;

class OrderComponent extends Component
{
    public $orders = [];
    public $loading = true;
    public $error = null;
    public $selectedOrder = null;
    public $showModal = false;
    public $availablePickers;
    public $availablePackers;

    public function mount()
    {
        if (!auth()->guard('admin')->user()->is_admin) {
            return redirect()->route('dashboard');
        }
        
        $this->loadOrders();
        $this->loadPickersAndPackers();
    }

    protected function getListeners()
    {
        return [
            'refreshOrders' => 'loadOrders',
            '$refresh'
        ];
    }

    public function loadOrders()
    {
        try {
            $this->loading = true;
            $response = Http::get('http://myshop.local/api/sync-orders');
            if (!$response->successful()) {
                throw new \Exception('Failed to sync with MyShop');
            }
            // Load orders with both picker and packer relationships
            $this->orders = Order::with(['picker', 'packer'])
                ->orderBy('created_at', 'desc')
                ->get()
                ->toArray();
            $this->error = null;
        } catch (\Exception $e) {
            $this->error = "Failed to load orders: " . $e->getMessage();
            \Log::error('Order sync failed: ' . $e->getMessage());
        } finally {
            $this->loading = false;
        }
    }

    public function loadPickersAndPackers()
    {
        // Get users with picker role
        $this->availablePickers = AdminUser::whereHas('roles', function($query) {
            $query->where('slug', 'picker');
        })->get();

        // Get users with packer role
        $this->availablePackers = AdminUser::whereHas('roles', function($query) {
            $query->where('slug', 'packer');
        })->get();
    }

    public function viewOrder($orderId)
    {
        $this->selectedOrder = Order::find($orderId);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->selectedOrder = null;
    }

    public function assignPicker($orderId, $pickerId)
    {
        $order = Order::find($orderId);  // Changed from OrderModel
        
        // Update picker and status
        $order->update([
            'picker_id' => $pickerId,
            'status' => $pickerId ? 'ready_to_pick' : 'placed'
        ]);

        // Refresh orders immediately after update
        $this->loadOrders();

        session()->flash('message', $pickerId
            ? 'Picker assigned and order status updated to Ready to Pick!'
            : 'Picker assignment removed and order status returned to Placed!'
        );

        // Replace emit() with dispatch()
        $this->dispatch('orderUpdated');
    }

    public function assignPacker($orderId, $packerId)
    {
        $order = Order::find($orderId);
        
        $order->update([
            'packer_id' => $packerId,
            'status' => $packerId ? 'ready_to_pack' : 'picked'
        ]);

        $this->loadOrders();

        session()->flash('message', $packerId
            ? 'Packer assigned and order status updated to Ready to Pack!'
            : 'Packer assignment removed!'
        );

        $this->dispatch('orderUpdated');
    }

    public function render()
    {
        return view('livewire.order-component', [
            'orders' => Order::with(['picker', 'packer'])->orderBy('created_at', 'desc')->get(),
            'pickers' => AdminUser::whereHas('roles', function($query) {
                $query->where('slug', 'picker');
            })->get(),
            'packers' => AdminUser::whereHas('roles', function($query) {
                $query->where('slug', 'packer');
            })->get()
        ]);
    }
}