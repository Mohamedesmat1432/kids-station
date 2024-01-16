<?php

namespace App\Livewire\Order;

use App\Traits\OrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteOrder extends Component
{
    use OrderTrait;
    public $bulk_delete_modal = false;
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
        $this->authorize('bulk-delete-order');
        $this->bulkDeleteOrder();
        $this->dispatch('bulk-delete-order');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('site.order_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.order.bulk-delete-order');
    }
}
