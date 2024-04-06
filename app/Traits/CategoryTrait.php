<?php

namespace App\Traits;

use App\Models\Category;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait CategoryTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait, WithFileUploads;

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

    public function storeCategory()
    {
        $this->authorize('create-category');
        $validated = $this->validate();
        Category::create($validated);
        $this->reset();
        $this->dispatch('refresh-list-category');
        $this->successNotify(__('site.category_created'));
        $this->create_modal = false;
    }


    public function setCategory($id)
    {
        $this->category = Category::withoutTrashed()->findOrFail($id);
        $this->category_id = $this->category->id;
        $this->name = $this->category->name;
    }

    public function updateCategory()
    {
        $this->authorize('edit-category');
        $validated = $this->validate();
        $this->category->update($validated);
        $this->reset();
        $this->dispatch('refresh-list-category');
        $this->successNotify(__('site.category_updated'));
        $this->edit_modal = false;
    }

    public function deleteCategory($id)
    {
        $this->authorize('delete-category');
        $category = Category::withoutTrashed()->findOrFail($id);
        $category->delete();
        $this->reset();
        $this->dispatch('refresh-list-category');
        $this->successNotify(__('site.category_deleted'));
        $this->delete_modal = false;
    }

    public function restoreCategory($id)
    {
        $this->authorize('restore-category');
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        $this->reset();
        $this->dispatch('refresh-list-category');
        $this->successNotify(__('site.category_restored'));
        $this->restore_modal = false;
    }

    public function forceDeleteCategory($id)
    {
        $this->authorize('force-delete-category');
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-category');
        $this->successNotify(__('site.category_deleted'));
        $this->force_delete_modal = false;
    }

    public function checkboxAll()
    {
        $categories_trashed = Category::onlyTrashed()->pluck('id')->toArray();
        $categories = Category::withoutTrashed()->pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trash ? $categories_trashed : $categories;

        if ($checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteCategory($arr)
    {
        $this->authorize('bulk-delete-category');
        $categories = Category::withoutTrashed()->whereIn('id', $arr);
        $categories->delete();
        $this->reset();
        $this->dispatch('refresh-list-category');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.category_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function forceBulkDeleteCategory($arr)
    {
        $this->authorize('force-bulk-delete-category');
        $categories = Category::onlyTrashed()->whereIn('id', $arr);
        $categories->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-category');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.category_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
}
