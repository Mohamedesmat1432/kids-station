<?php

namespace App\Livewire\ProductOrder;

use App\Traits\ProductOrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteProductOrder extends Component
{
    use ProductOrderTrait;
    public $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->checkbox_arr = json_decode($arr);
        $this->count = count($this->checkbox_arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('bulk-delete-product-order');
        $this->bulkDeleteProductOrder();
        $this->dispatch('refresh-list-product-order');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.product_order_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.product-order.bulk-delete-product-order');
    }
}
