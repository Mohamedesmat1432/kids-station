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
        $this->forceBulkDeleteProductOrder($this->checkbox_arr);
    }

    public function render()
    {
        return view('livewire.product-order.force-bulk-delete-product-order');
    }
}
