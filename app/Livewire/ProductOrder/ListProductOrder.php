<?php

namespace App\Livewire\ProductOrder;

use App\Models\ProductOrder;
use App\Traits\SortSearchTrait;
use Livewire\Component;
use Livewire\WithPagination;

class ListProductOrder extends Component
{
    use WithPagination, SortSearchTrait;

    public function render()
    {
        $this->authorize('view-product-order');

        $product_orders = ProductOrder::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('total', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        return view('livewire.product-order.list-product-order',[
            'product_orders' => $product_orders
        ]);
    }
}
