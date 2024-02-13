<?php

namespace App\Traits;

use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait CategoryTrait
{
    use WithNotify;
    use SortSearchTrait;
    use WithPagination;
    use ModalTrait;
    use WithFileUploads;

    public ?Category $category;
    public $category_id;
    public $name;
    public $checkbox_arr = [];
    public $file;
    public $extension = 'xlsx';

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:categories,name,' . $this->category_id,
        ];
    }

    public function categoryList()
    {
        return cache()->remember('categories', 1, function () {
            $categories = $this->trashed ? Category::onlyTrashed() : new Category();

            return $categories->when($this->search, function ($query) {
                    return $query->where(function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
                })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }

    public function setCategory($id)
    {
        $this->category = Category::findOrFail($id);
        $this->category_id = $this->category->id;
        $this->name = $this->category->name;
    }

    public function storeCategory()
    {
        $validated = $this->validate();
        Category::create($validated);
        $this->reset();
    }

    public function updateCategory()
    {
        $validated = $this->validate();
        $this->category->update($validated);
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
    }

    public function restoreCategory($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
    }

    public function forceDeleteCategory($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
    }

    public function checkboxAll()
    {
        $categories_trashed = Category::onlyTrashed()->pluck('id')->toArray();
        $categories = Category::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trashed ? $categories_trashed : $categories;

        if ($checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteCategory()
    {
        $categories = Category::whereIn('id', $this->checkbox_arr);
        $categories->delete();
    }

    public function forceBulkDeleteCategory()
    {
        $categories = Category::onlyTrashed()->whereIn('id', $this->checkbox_arr);
        $categories->forceDelete();
    }
}
