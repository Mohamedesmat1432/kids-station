<?php

namespace App\Livewire\Cart;

use App\Models\Product;
use App\Traits\CartTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Cart;

class UpdateCart extends Component
{
    use CartTrait;

    public function mount($item)
    {
        $this->cartItems = $item;

        $this->quantity = $item['quantity'];
    }

    public function updateCart()
    {
        if ($this->quantity < Product::findOrFail($this->cartItems['id'])->qty) {
            Cart::update($this->cartItems['id'], [
                'quantity' => [
                    'relative' => false,
                    'value' => $this->quantity,
                ],
            ]);

            $this->dispatch('update-cart');
        } else {
            $this->successNotify(__('site.qty_bigger_than_product'));
        }
    }

    public function render()
    {
        return view('livewire.cart.update-cart');
    }
}
