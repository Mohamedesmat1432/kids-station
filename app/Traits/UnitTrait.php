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
    public $checkbox_arr = [];
    public $file;
    public $extension = 'xlsx';

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:units,name,' . $this->unit_id,
            'qty' => 'required|numeric',
        ];
    }

    public function unitList()
    {
        return cache()->remember('units', 1, function () {

            $units = $this->trashed ? Unit::onlyTrashed() : Unit::withoutTrashed();

            return $units->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }

    public function setUnit($id)
    {
        $this->unit = Unit::findOrFail($id);
        $this->unit_id = $this->unit->id;
        $this->name = $this->unit->name;
        $this->qty = $this->unit->qty;
    }

    public function storeUnit()
    {
        $validated = $this->validate();
        Unit::create($validated);
        $this->reset();
    }

    public function updateUnit()
    {
        $validated = $this->validate();
        $this->unit->update($validated);
    }

    public function deleteUnit($id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
    }

    public function checkboxAll()
    {
        $units_trashed = Unit::onlyTrashed()->pluck('id')->toArray();
        $units = Unit::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trashed ? $units_trashed : $units;

        if ($checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteUnit()
    {
        $units = Unit::whereIn('id', $this->checkbox_arr);
        $units->delete();
    }

    public function restoreUnit($id)
    {
        $unit = Unit::onlyTrashed()->findOrFail($id);
        $unit->restore();
    }

    public function forceDeleteUnit($id)
    {
        $unit = Unit::onlyTrashed()->findOrFail($id);
        $unit->forceDelete();
    }

    public function forceBulkDeleteUnit()
    {
        $units = Unit::onlyTrashed()->whereIn('id', $this->checkbox_arr);
        $units->forceDelete();
    }
}
