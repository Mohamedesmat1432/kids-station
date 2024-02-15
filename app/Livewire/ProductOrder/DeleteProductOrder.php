<?php

namespace App\Livewire\ProductOrder;

use App\Traits\ProductOrderTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteProductOrder extends Component
{
    use ProductOrderTrait;

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
        $this->authorize('delete-product-order');
        $this->deleteProductOrder($this->id);
        $this->dispatch('refresh-list-product-order');
        $this->successNotify(__('site.product_order_deleted'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.product-order.delete-product-order');
    }
}
