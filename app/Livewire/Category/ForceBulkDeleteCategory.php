<?php

namespace App\Livewire\Category;

use App\Traits\CategoryTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceBulkDeleteCategory extends Component
{
    use CategoryTrait;
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
        $this->authorize('force-bulk-delete-category');
        $this->forceBulkDeleteCategory();
        $this->dispatch('force-bulk-delete-category');
        $this->dispatch('force-bulk-delete-clear');
        $this->successNotify(__('site.category_delete_all'));
        $this->force_bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.category.force-bulk-delete-category');
    }
}
