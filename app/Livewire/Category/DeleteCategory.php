<?php

namespace App\Livewire\Category;

use App\Traits\CategoryTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteCategory extends Component
{
    use CategoryTrait;
    public $delete_modal = false;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('delete-category');
        $this->deleteCategory($this->id);
        $this->dispatch('delete-category');
        $this->successNotify(__('site.category_deleted'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.category.delete-category');
    }
}
