<?php

namespace App\Livewire\ProductOrder;

use App\Traits\ProductOrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceBulkDeleteProductOrder extends Component
{
    use ProductOrderTrait;

    public $count;

    #[On('force-bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->checkbox_arr = json_decode($arr);
        $this->count = count($this->checkbox_arr);
        $this->force_bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('force-bulk-delete-product-order');
        $this->forceBulkDeleteOrder();
        $this->dispatch('force-bulk-delete-product-order');
        $this->dispatch('force-bulk-delete-clear');
        $this->successNotify(__('site.product_order_delete_all'));
        $this->force_bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.product-order.force-bulk-delete-product-order');
    }
}
