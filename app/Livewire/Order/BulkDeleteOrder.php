<?php

namespace App\Livewire\Order;

use App\Traits\OrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteOrder extends Component
{
    use OrderTrait;
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
        $this->bulkDeleteOrder($this->checkbox_arr);
    }

    public function render()
    {
        return view('livewire.order.bulk-delete-order');
    }
}
