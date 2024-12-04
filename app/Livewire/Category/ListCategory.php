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
        $this->checkbox_status = false;
    }

    #[On('refresh-list-category')]
    public function render()
    {
        $this->authorize('view-category');

        $category = $this->trash ? Category::onlyTrashed() : Category::withoutTrashed();

        $categories = $category->search($this->search)
            ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        $this->checkbox_all = $categories->pluck('id')->toArray();

        return view('livewire.category.list-category', [
            'categories' => $categories,
        ]);
    }
}
