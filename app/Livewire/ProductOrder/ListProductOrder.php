<?php

namespace App\Livewire\ProductOrder;

use App\Traits\ProductOrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListProductOrder extends Component
{
    use ProductOrderTrait;

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }
    
    #[On('refresh-list-product-order')]
    public function render()
    {
        return view('livewire.product-order.list-product-order', [
            'product_orders' => $this->productOrderList(),
        ])->layout('layouts.app');
    }
}
