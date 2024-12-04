<?php

namespace App\Traits;

use App\Models\Unit;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait UnitTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait, WithFileUploads;

    public ?Unit $unit;
    public $unit_id;
    public $name;
    public $qty;
    public $file;
    public $extension = 'xlsx';

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:units,name,' . $this->unit_id,
            'qty' => 'required|numeric',
        ];
    }

    public function setUnit($id)
    {
        $this->unit = Unit::withoutTrashed()->findOrFail($id);
        $this->unit_id = $this->unit->id;
        $this->name = $this->unit->name;
        $this->qty = $this->unit->qty;
    }

    public function storeUnit()
    {
        $this->authorize('create-unit');
        $validated = $this->validate();
        Unit::create($validated);
        $this->reset();
        $this->dispatch('refresh-list-unit');
        $this->successNotify(__('site.unit_created'));
        $this->create_modal = false;
    }

    public function updateUnit()
    {
        $this->authorize('edit-unit');
        $validated = $this->validate();
        $this->unit->update($validated);
        $this->reset();
        $this->dispatch('refresh-list-unit');
        $this->successNotify(__('site.unit_updated'));
        $this->edit_modal = false;
    }

    public function deleteUnit($id)
    {
        $this->authorize('delete-unit');
        $unit = Unit::withoutTrashed()->findOrFail($id);
        $unit->delete();
        $this->reset();
        $this->dispatch('refresh-list-unit');
        $this->successNotify(__('site.unit_deleted'));
        $this->delete_modal = false;
    }


    public function bulkDeleteUnit($arr)
    {
        $this->authorize('bulk-delete-unit');
        $units = Unit::withoutTrashed()->whereIn('id', $arr);
        $units->delete();
        $this->reset();
        $this->dispatch('refresh-list-unit');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.unit_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function restoreUnit($id)
    {
        $this->authorize('restore-unit');
        $unit = Unit::onlyTrashed()->findOrFail($id);
        $unit->restore();
        $this->reset();
        $this->dispatch('refresh-list-unit');
        $this->successNotify(__('site.unit_restored'));
        $this->restore_modal = false;
    }

    public function forceDeleteUnit($id)
    {
        $this->authorize('force-delete-unit');
        $unit = Unit::onlyTrashed()->findOrFail($id);
        $unit->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-unit');
        $this->successNotify(__('site.unit_deleted'));
        $this->force_delete_modal = false;
    }

    public function forceBulkDeleteUnit($arr)
    {
        $this->authorize('force-bulk-delete-unit');
        $units = Unit::onlyTrashed()->whereIn('id', $arr);
        $units->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-unit');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.unit_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
}
