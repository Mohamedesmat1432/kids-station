<?php

namespace App\Traits;

use App\Models\Unit;

trait UnitTrait
{
    use WithNotify;
    public ?Unit $unit;
    public $unit_id;
    public $name;
    public $qty;
    public $checkbox_arr = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:units,name,' . $this->unit_id,
            'qty' => 'required|numeric'
        ];
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
        $data = Unit::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
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
}
