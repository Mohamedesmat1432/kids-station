<?php

namespace App\Livewire\Product;

use App\Traits\ProductTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceBulkDeleteProduct extends Component
{
    use ProductTrait;
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
        $this->forceBulkDeleteProduct($this->checkbox_arr);
    }

    public function render()
    {
        return view('livewire.product.force-bulk-delete-product');
    }
}
