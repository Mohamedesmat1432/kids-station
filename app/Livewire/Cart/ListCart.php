<?php

namespace App\Livewire\Cart;

use App\Traits\CartTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListCart extends Component
{
    use CartTrait;

    #[On('refresh-list-cart')]
    public function render()
    {
        $this->cartItems = $this->cartData();

        return view('livewire.cart.list-cart');
    }

}
