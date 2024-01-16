<?php

namespace App\Livewire\Cart;

use App\Traits\CartTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListCart extends Component
{
    use CartTrait;

    #[On('add-to-cart')]
    #[On('update-cart')]
    #[On('remove-from-cart')]
    #[On('remove-all-cart')]
    public function render()
    {
        $this->cartItems = $this->cartData();

        return view('livewire.cart.list-cart');
    }

}
