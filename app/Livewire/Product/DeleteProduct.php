<?php

namespace App\Livewire\Product;

use App\Traits\ProductTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteProduct extends Component
{
    use ProductTrait;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('delete-product');
        $this->deleteProduct($this->id);
        $this->dispatch('refresh-list-product');
        $this->successNotify(__('site.product_deleted'));
        $this->reset();
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.product.delete-product');
    }
}
