<?php

namespace App\Livewire\ProductOrder;

use App\Traits\ProductOrderTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreProductOrder extends Component
{
    use ProductOrderTrait;

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
        $this->authorize('restore-product-order');
        $this->restoreProductOrder($this->id);
        $this->dispatch('restore-product-order');
        $this->successNotify(__('site.product_order_restored'));
        $this->restore_modal = false;
    }

    public function render()
    {
        return view('livewire.product-order.restore-product-order');
    }
}
