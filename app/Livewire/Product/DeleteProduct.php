<?php

namespace App\Livewire\Product;

use App\Traits\ProductTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteProduct extends Component
{
    use ProductTrait;
    public $delete_modal = false;

    #[Locked]
    public $product_id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->product_id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('delete-product');
        $this->deleteProduct($this->product_id);
        $this->dispatch('delete-product');
        $this->successNotify(__('site.product_deleted'));
        $this->reset();
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.product.delete-product');
    }
}
