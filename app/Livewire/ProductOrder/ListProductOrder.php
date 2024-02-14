<?php

namespace App\Livewire\ProductOrder;

use App\Traits\ProductOrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListProductOrder extends Component
{
    use ProductOrderTrait;

    #[On('bulk-delete-clear')]
    #[On('force-bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }
    
    #[On('delete-product-order')]
    #[On('bulk-delete-product-order')]
    #[On('restore-product-order')]
    #[On('force-delete-product-order')]
    #[On('force-bulk-delete-product-order')]
    public function render()
    {
        $this->authorize('view-product-order');

        $product_orders = $this->productOrderList();

        return view('livewire.product-order.list-product-order', [
            'product_orders' => $product_orders,
        ]);
    }
}
