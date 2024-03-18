<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Unit;
use App\Traits\ProductTrait;
use Livewire\Component;

class CreateProduct extends Component
{
    use ProductTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storeProduct();
    }
    public function render()
    {
        return view('livewire.product.create-product',[
            'categories' => Category::pluck('name','id')->toArray(),
            'units' => Unit::pluck('name','id')->toArray(),
        ]);
    }
}
