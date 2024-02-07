<?php

namespace App\Livewire\Product;

use App\Models\Product;
use App\Traits\ProductTrait;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListProduct extends Component
{
    use WithPagination, SortSearchTrait, ProductTrait;

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-product')]
    #[On('update-product')]
    #[On('delete-product')]
    #[On('import-product')]
    #[On('export-product')]
    #[On('bulk-delete-product')]
    public function render()
    {
        $this->authorize('view-product');

        $products = cache()->remember('products', 1, function () {
            return Product::when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')->orWhere('price', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });

        return view('livewire.product.list-product', [
            'products' => $products,
        ]);
    }
}
