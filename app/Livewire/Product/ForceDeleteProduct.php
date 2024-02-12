<?php

namespace App\Livewire\Product;

use App\Traits\ProductTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceDeleteProduct extends Component
{
    use ProductTrait;

    #[Locked]
    public $id, $name;

    #[On('force-delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->force_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('force-delete-product');
        $this->forceDeleteProduct($this->id);
        $this->dispatch('force-delete-product');
        $this->successNotify(__('site.product_deleted'));
        $this->reset();
        $this->force_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.product.force-delete-product');
    }
}
