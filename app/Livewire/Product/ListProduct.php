<?php

namespace App\Livewire\Product;

use App\Traits\ProductTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListProduct extends Component
{
    use ProductTrait;

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('refresh-list-product')]
    public function render()
    {
        $this->authorize('view-product');

        return view('livewire.product.list-product', [
            'products' => $this->productList(),
        ])->layout('layouts.app');

    }
}
