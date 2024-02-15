<?php

namespace App\Livewire\Category;

use App\Models\Category;
use App\Traits\CategoryTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListCategory extends Component
{
    use CategoryTrait;

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('refresh-list-category')]
    public function render()
    {
        $this->authorize('view-category');
        $categories = $this->categoryList();

        return view('livewire.category.list-category', [
            'categories' => $categories,
        ]);
    }
}
