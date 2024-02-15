<?php

namespace App\Livewire\Category;

use App\Traits\CategoryTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateCategory extends Component
{
    use CategoryTrait;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setCategory($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->authorize('edit-category');
        $this->updateCategory();
        $this->dispatch('refresh-list-category');
        $this->successNotify(__('site.category_updated'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.category.update-category');
    }
}
