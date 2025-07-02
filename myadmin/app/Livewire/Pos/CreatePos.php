<?php

namespace App\Livewire\Pos;

use Livewire\Component;
use App\Models\ImageForm;
use Illuminate\Support\Facades\DB;
use App\Models\Pos;
use App\Models\PosItem;

class CreatePos extends Component
{
    public $search = '';
    public $products;
    public $cart = [];
    public $total = 0;
    public $tax = 0;
    public $searchResults;

    public function mount()
    {
        $this->products = ImageForm::all();
        $this->searchResults = $this->products;
    }

    public function addToCart($productId)
    {
        $product = ImageForm::find($productId);
        
        if ($product && $product->qty > 0) {
            if (isset($this->cart[$productId])) {
                if ($this->cart[$productId]['quantity'] < $product->qty) {
                    $this->cart[$productId]['quantity']++;
                }
            } else {
                $this->cart[$productId] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'barcode' => $product->barcode,
                    'id' => $product->id
                ];
            }
            $this->calculateTotal();
        }
    }

    public function decreaseQuantity($productId)
    {
        if (isset($this->cart[$productId])) {
            if ($this->cart[$productId]['quantity'] > 1) {
                $this->cart[$productId]['quantity']--;
            } else {
                unset($this->cart[$productId]);
            }
            $this->calculateTotal();
        }
    }

    public function removeFromCart($productId)
    {
        if (isset($this->cart[$productId])) {
            unset($this->cart[$productId]);
            $this->calculateTotal();
        }
    }

    public function updatedSearch()
    {
        if (!empty($this->search)) {
            $product = ImageForm::where('barcode', $this->search)->first();
            
            if ($product) {
                $this->addToCart($product->id);
                $this->search = '';
                $this->dispatch('searchUpdated', $this->search);
            }
        }
    }

    private function calculateTotal()
    {
        $this->total = 0;
        foreach ($this->cart as $item) {
            $this->total += $item['price'] * $item['quantity'];
        }
        $this->tax = $this->total * 0.15;
    }

    public function processPayment()
    {
        try {
            DB::beginTransaction();

            // Create payment record
            $payment = Pos::createPayment($this->total, $this->tax);

            // Update product quantities and create PosItems
            foreach ($this->cart as $productId => $item) {
                // Create PosItem record
                try{
                PosItem::create([
                    'pos_id' => $payment->id,
                    'item_name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity']
                ]);

                // Update product quantities
                ImageForm::where('id', $productId)
                        ->decrement('qty', $item['quantity']);
                } catch (\Exception $e) {
                    dd($e->getMessage());
                }
            }

            DB::commit();

            // Clear cart
            $this->cart = [];
            $this->total = 0;
            $this->tax = 0;

            session()->flash('message', 'Payment processed successfully! Payment ID: ' . $payment->payment_id);

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Error processing payment: ' . $e->getMessage());
        }
    }

    public function render()
    {
        if (empty($this->search)) {
            $this->searchResults = $this->products;
        }
        return view('livewire.pos.create-pos');
    }
}
