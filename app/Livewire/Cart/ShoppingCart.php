<?php

namespace App\Livewire\Cart;

use App\Traits\CartTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ShoppingCart extends Component
{
    use CartTrait;
  
    #[On('refresh-list-product')]
    #[On('refresh-list-product-order')]
    public function render()
    {
        $this->authorize('view-shopping-cart');

        return view('livewire.cart.shopping-cart', [
            'products' => $this->productList(),
        ])->layout('layouts.app');
    }
}
