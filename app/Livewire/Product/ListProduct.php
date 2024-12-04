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
        $this->checkbox_status = false;
    }

    #[On('refresh-list-product')]
    public function render()
    {
        $this->authorize('view-product');

        $products = $this->trash ? Product::onlyTrashed() : Product::withoutTrashed();

        $products = $products->search($this->search)
            ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        $this->checkbox_all = $products->pluck('id')->toArray();

        return view('livewire.product.list-product', [
            'products' => $products,
        ])->layout('layouts.app');

    }
}
