<?php

namespace App\Livewire\Order;

use App\Traits\OrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceBulkDeleteOrder extends Component
{
    use OrderTrait;

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
        $this->authorize('force-bulk-delete-order-kids');
        $this->forceBulkDeleteOrder();
        $this->dispatch('refresh-list-order-kids');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.order_delete_all'));
        $this->force_bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.order.force-bulk-delete-order');
    }
}
