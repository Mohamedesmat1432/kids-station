<?php

namespace App\Livewire\Product;

use App\Models\Product;
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

        $products = $this->trash ? Product::onlyTrashed() : Product::withoutTrashed();

        $products = $products->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->search($this->search)->paginate($this->page_element);

        return view('livewire.product.list-product', [
            'products' => $products,
        ])->layout('layouts.app');

    }
}
