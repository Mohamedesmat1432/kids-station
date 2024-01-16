<?php

namespace App\Livewire\Cart;

use App\Traits\CartTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Cart;

class UpdateCart extends Component
{
    protected $listeners = ['updateCart'=> '$refresh'];
    use CartTrait;

    public function mount($item)
    {
        $this->cartItems = $item;

        $this->quantity = $item['quantity'];
    }

    public function updateCart()
    {
        Cart::update($this->cartItems['id'], [
            'quantity' => [
                'relative' => false,
                'value' => $this->quantity
            ]
        ]);

        $this->dispatch('update-cart');
    }

    public function render()
    {
        return view('livewire.cart.update-cart');
    }
}
