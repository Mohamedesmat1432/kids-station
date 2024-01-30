<?php

namespace App\Livewire\Category;

use App\Models\Category;
use App\Traits\CategoryTrait;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListCategory extends Component
{
    use WithPagination, SortSearchTrait, CategoryTrait;

    #[On('bulk-delete-clear')]
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
    public function render()
    {
        $this->authorize('view-category');

        $categories = Category::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.category.list-category', [
            'categories' => $categories
        ]);
    }
}
