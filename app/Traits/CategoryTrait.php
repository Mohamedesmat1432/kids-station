<?php

namespace App\Traits;

use App\Models\Category;

trait CategoryTrait
{
    use WithNotify;
    public ?Category $category;
    public $category_id;
    public $name;
    public $checkbox_arr = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:categories,name,' . $this->category_id,
        ];
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

    public function checkboxAll()
    {
        $data = Category::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
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
}
