<?php

namespace App\Livewire\Cart;

use App\Models\Product;
use App\Traits\CartTrait;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ShoppingCart extends Component
{
    use WithPagination, SortSearchTrait, CartTrait;
  
    #[On('create-product')]
    #[On('update-product')]
    #[On('delete-product')]
    #[On('import-product')]
    #[On('export-product')]
    #[On('bulk-delete-product')]
    #[On('create-product-order')]
    public function render()
    {
        $this->authorize('view-shopping-cart');

        $products = Product::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('price', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        return view('livewire.cart.shopping-cart', [
            'products' => $products,
        ]);
    }
}
