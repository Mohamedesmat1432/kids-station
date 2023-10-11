<?php

namespace App\Livewire\Forms;

use App\Models\Point;
use Livewire\Form;

class PointForm extends Form
{
    public ?Point $point;

    public $point_id;
    public $name;
    public $checkbox_arr = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:points,name,' . $this->point_id
        ];
    }

    protected $validationAttributes = [
        'name' => 'Name',
    ];

    public function setPoint(Point $point)
    {
        $this->point = $point;
        $this->point_id = $point->id;
        $this->name = $point->name;
    }

    public function store()
    {
        $validated = $this->validate();
        Point::create($validated);
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();
        $this->point->update($validated);
    }

    public function delete($id)
    {
        $point = Point::findOrFail($id);
        $point->edokis()->update(['point_id' => null]);
        $point->emadEdeens()->update(['point_id' => null]);
        $point->delete();
    }

    public function checkboxAll()
    {
        $data = Point::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDelete()
    {
        $points = Point::whereIn('id', $this->checkbox_arr);

        foreach ($points as $point) {
            $point->edokis()->update(['point_id' => null]);
            $point->emadEdeens()->update(['point_id' => null]);
        }

        $points->delete();
    }
}
