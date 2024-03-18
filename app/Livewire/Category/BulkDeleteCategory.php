<?php

namespace App\Livewire\Category;

use App\Traits\CategoryTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteCategory extends Component
{
    use CategoryTrait;
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
        $this->bulkDeleteCategory($this->checkbox_arr);
    }

    public function render()
    {
        return view('livewire.category.bulk-delete-category');
    }
}
