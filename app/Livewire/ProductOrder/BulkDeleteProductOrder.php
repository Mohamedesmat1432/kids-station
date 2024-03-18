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
        $this->bulkDeleteProductOrder($this->checkbox_arr);
    }

    public function render()
    {
        return view('livewire.product-order.bulk-delete-product-order');
    }
}
