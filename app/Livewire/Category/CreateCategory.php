<?php

namespace App\Livewire\Category;

use App\Traits\CategoryTrait;
use Livewire\Component;

class CreateCategory extends Component
{
    use CategoryTrait;
    public $create_modal = false;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->authorize('create-category');
        $this->storeCategory();
        $this->dispatch('create-category');
        $this->successNotify(__('site.category_created'));
        // $this->create_modal = false;
    }

    public function render()
    {
        return view('livewire.category.create-category');
    }
}
