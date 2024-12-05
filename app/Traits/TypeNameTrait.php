<?php

namespace App\Traits;

use App\Models\TypeName;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait TypeNameTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait, WithFileUploads;

    public ?TypeName $type_name;
    public $type_name_id;
    public $name;
    public $file;
    public $extension = 'xlsx';

    protected function rules()
    {
        return [
            'name' => 'required|string',
            'status' => 'required|boolean',
        ];
    }

    public function setTypeName($id)
    {
        $this->type_name = TypeName::withoutTrashed()->findOrFail($id);
        $this->type_name_id = $this->type_name->id;
        $this->name = $this->type_name->name;
        $this->status = $this->type_name->status;
    }

    public function storeTypeName()
    {
        $this->authorize('create-type-name');
        $validated = $this->validate();
        TypeName::create($validated);
        $this->reset();
        $this->dispatch('refresh-list-type-name');
        $this->successNotify(__('site.type_name_created'));
        $this->create_modal = false;
    }

    public function updateTypeName()
    {
        $this->authorize('edit-type-name');
        $validated = $this->validate();
        $this->type_name->update($validated);
        $this->reset();
        $this->dispatch('refresh-list-type-name');
        $this->successNotify(__('site.type_name_updated'));
        $this->edit_modal = false;
    }

    public function deleteTypeName($id)
    {
        $this->authorize('delete-type-name');
        $type_name = TypeName::withoutTrashed()->findOrFail($id);
        $type_name->delete();
        $this->reset();
        $this->dispatch('refresh-list-type-name');
        $this->successNotify(__('site.type_name_deleted'));
        $this->delete_modal = false;
    }

    public function bulkDeleteTypeName($arr)
    {
        $this->authorize('bulk-delete-type-name');
        $type_names = TypeName::withoutTrashed()->whereIn('id', $arr);
        $type_names->delete();
        $this->reset();
        $this->dispatch('refresh-list-type-name');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.type_name_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function restoreTypeName($id)
    {
        $this->authorize('restore-type-name');
        $type_name = TypeName::onlyTrashed()->findOrFail($id);
        $type_name->restore();
        $this->reset();
        $this->dispatch('refresh-list-type-name');
        $this->successNotify(__('site.type_restored'));
        $this->restore_modal = false;
    }

    public function forceDeleteTypeName($id)
    {
        $this->authorize('force-delete-type-name');
        $type_name = TypeName::onlyTrashed()->findOrFail($id);
        $type_name->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-type-name');
        $this->successNotify(__('site.type_name_deleted'));
        $this->force_delete_modal = false;
    }

    public function forceBulkDeleteTypeName($arr)
    {
        $this->authorize('force-bulk-delete-type-name');
        $type_names = TypeName::onlyTrashed()->whereIn('id', $arr);
        $type_names->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-type-name');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.type_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
}
