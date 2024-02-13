<?php

namespace App\Livewire\Product;

use App\Traits\ProductTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreProduct extends Component
{
    use ProductTrait;

    #[Locked]
    public $id, $name;

    #[On('restore-modal')]
    public function confirmRestore($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->restore_modal = true;
    }

    public function restore()
    {
        $this->authorize('restore-product');
        $this->restoreProduct($this->id);
        $this->dispatch('restore-product');
        $this->successNotify(__('site.product_restored'));
        $this->restore_modal = false;
    }

    public function render()
    {
        return view('livewire.product.restore-product');
    }
}
