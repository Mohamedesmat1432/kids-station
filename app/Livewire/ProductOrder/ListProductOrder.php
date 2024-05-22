<?php

namespace App\Livewire\ProductOrder;

use App\Models\ProductOrder;
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
        $this->authorize('view-product-order');

        $product_orders = $this->trash ? ProductOrder::onlyTrashed() : ProductOrder::withoutTrashed();
        
        $product_orders = $product_orders->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->search($this->search, $this->date)->paginate($this->page_element);

        return view('livewire.product-order.list-product-order', [
            'product_orders' => $product_orders,
        ]);
    }
}
