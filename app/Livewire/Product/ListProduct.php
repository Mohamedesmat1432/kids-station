<?php

namespace App\Livewire\Product;

use App\Traits\ProductTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListProduct extends Component
{
    use ProductTrait;

    #[On('bulk-delete-clear')]
    #[On('force-bulk-delete-clear')]
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
    #[On('force-bulk-delete-product')]
    #[On('force-delete-product')]
    #[On('restore-product')]
    public function render()
    {
        $this->authorize('view-product');

        $products = $this->productList();

        return view('livewire.product.list-product', [
            'products' => $products,
        ]);
    }
}
