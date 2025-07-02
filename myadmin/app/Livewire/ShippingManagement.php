<?php


namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use App\Models\AdminUser;

class ShippingManagement extends Component
{
    public $selectedOrders = '';  
    public $selectedRider;
    public $availableRiders;
    public $error;

    public function mount()
    {
        if (!auth()->guard('admin')->user()->is_admin) {
            return redirect()->route('dashboard');
        }
        
        $this->loadRiders();
    }

    public function loadRiders()
    {
        $this->availableRiders = AdminUser::whereHas('roles', function($query) {
            $query->where('slug', 'rider');
        })->get();
    }

    public function assignRider()
    {
        
        if (empty($this->selectedOrders) || empty($this->selectedRider)) {
            $this->error = 'Please enter order numbers and select a rider';
            return;
        }

        try {
            
            $orderIds = array_filter(
                array_map(function($id) {
                    return trim(str_replace('#', '', $id));
                }, explode("\n", $this->selectedOrders)),
                'strlen'
            );

            if (empty($orderIds)) {
                $this->error = 'No valid order numbers found';
                return;
            }

            
            $updatedCount = Order::whereIn('id', $orderIds)
                ->where('status', 'completed')
                ->whereNull('rider_id')
                ->update([
                    'rider_id' => $this->selectedRider,
                    'status' => 'shipped'  
                ]);

            
            $this->selectedOrders = '';
            $this->selectedRider = null;
            $this->error = null;
            
            session()->flash('message', "Successfully assigned {$updatedCount} orders to rider");
            
        } catch (\Exception $e) {
            $this->error = 'Failed to assign orders: ' . $e->getMessage();
        }
    }

    public function render()
    {
        return view('livewire.shipping-management', [
            'orders' => Order::where(function($query) {
                    $query->where('status', 'completed')
                          ->whereNull('rider_id');
                })
                ->orWhere('status', 'shipped')
                ->with(['rider'])
                ->orderBy('created_at', 'desc')
                ->get()
        ]);
    }
}