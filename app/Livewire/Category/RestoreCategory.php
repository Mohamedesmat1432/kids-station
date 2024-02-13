<?php

namespace App\Livewire\Category;

use App\Traits\CategoryTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreCategory extends Component
{
    use CategoryTrait;

    #[Locked]
    public $id, $name;

    #[On('restore-modal')]
    public function confirmRestore($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->restore_modal = true;
    }

    public function restore()
    {
        $this->authorize('restore-category');
        $this->restoreCategory($this->id);
        $this->dispatch('restore-category');
        $this->successNotify(__('site.category_restored'));
        $this->restore_modal = false;
    }


    public function render()
    {
        return view('livewire.category.restore-category');
    }
}
