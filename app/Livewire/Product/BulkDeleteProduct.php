<?php

namespace App\Livewire\Product;

use App\Traits\ProductTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteProduct extends Component
{
    use ProductTrait;
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
        $this->authorize('bulk-delete-product');
        $this->bulkDeleteProduct();
        $this->dispatch('refresh-list-product');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.product_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.product.bulk-delete-product');
    }
}
