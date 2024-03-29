<?php

namespace App\Livewire\Product;

use App\Models\Category;
use App\Models\Unit;
use App\Traits\ProductTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateProduct extends Component
{
    use ProductTrait;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setProduct($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->updateProduct();
    }

    public function render()
    {
        return view('livewire.product.update-product',[
            'categories' => Category::pluck('name','id')->toArray(),
            'units' => Unit::pluck('name','id')->toArray(),
        ]);
    }
}
