<?php

namespace App\Traits;

use App\Models\Type;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait TypeTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait, WithFileUploads;

    public ?Type $type;
    public $type_id;
    public $type_name_id;
    public $price;
    public $duration;
    public $file;
    public $extension = 'xlsx';

    protected function rules()
    {
        return [
            'type_name_id' => 'required|numeric|exists:type_names,id',
            'price' => 'required|numeric',
            'duration' => 'required|numeric',
            'status' => 'required|boolean',
        ];
    }

    public function setType($id)
    {
        $this->type = Type::withoutTrashed()->findOrFail($id);
        $this->type_id = $this->type->id;
        $this->type_name_id = $this->type->type_name_id;
        $this->price = $this->type->price;
        $this->duration = $this->type->duration;
        $this->status = $this->type->status;
    }

    public function storeType()
    {
        $this->authorize('create-type');
        $validated = $this->validate();
        Type::create($validated);
        $this->reset();
        $this->dispatch('refresh-list-type');
        $this->successNotify(__('site.type_created'));
        $this->create_modal = false;
    }

    public function updateType()
    {
        $this->authorize('edit-type');
        $validated = $this->validate();
        $this->type->update($validated);
        $this->reset();
        $this->dispatch('refresh-list-type');
        $this->successNotify(__('site.type_updated'));
        $this->edit_modal = false;
    }

    public function deleteType($id)
    {
        $this->authorize('delete-type');
        $type = Type::withoutTrashed()->findOrFail($id);
        $type->delete();
        $this->reset();
        $this->dispatch('refresh-list-type');
        $this->successNotify(__('site.type_deleted'));
        $this->delete_modal = false;
    }

    public function bulkDeleteType($arr)
    {
        $this->authorize('bulk-delete-type');
        $types = Type::withoutTrashed()->whereIn('id', $arr);
        $types->delete();
        $this->reset();
        $this->dispatch('refresh-list-type');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.type_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function restoreType($id)
    {
        $this->authorize('restore-type');
        $type = Type::onlyTrashed()->findOrFail($id);
        $type->restore();
        $this->reset();
        $this->dispatch('refresh-list-type');
        $this->successNotify(__('site.type_restored'));
        $this->restore_modal = false;
    }

    public function forceDeleteType($id)
    {
        $this->authorize('force-delete-type');
        $type = Type::onlyTrashed()->findOrFail($id);
        $type->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-type');
        $this->successNotify(__('site.type_deleted'));
        $this->force_delete_modal = false;
    }

    public function forceBulkDeleteType($arr)
    {
        $this->authorize('force-bulk-delete-type');
        $types = Type::onlyTrashed()->whereIn('id', $arr);
        $types->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-type');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.type_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
}
