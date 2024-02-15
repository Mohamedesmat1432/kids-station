<?php

namespace App\Livewire\Category;

use App\Traits\CategoryTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceDeleteCategory extends Component
{
    use CategoryTrait;

    #[Locked]
    public $id, $name;

    #[On('force-delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->force_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('force-delete-category');
        $this->forceDeleteCategory($this->id);
        $this->dispatch('refresh-list-category');
        $this->successNotify(__('site.category_deleted'));
        $this->force_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.category.force-delete-category');
    }
}
