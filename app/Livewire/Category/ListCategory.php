<?php

namespace App\Livewire\Category;

use App\Models\Category;
use App\Traits\CategoryTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListCategory extends Component
{
    use CategoryTrait;

    #[On('bulk-delete-clear')]
    #[On('force-bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-category')]
    #[On('update-category')]
    #[On('delete-category')]
    #[On('import-category')]
    #[On('export-category')]
    #[On('bulk-delete-category')]
    #[On('force-bulk-delete-category')]
    #[On('force-delete-category')]
    #[On('restore-category')]
    public function render()
    {
        $this->authorize('view-category');
        $categories = $this->categoryList();

        return view('livewire.category.list-category', [
            'categories' => $categories,
        ]);
    }
}
