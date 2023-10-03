<?php

namespace App\Livewire\Forms;

use App\Models\Point;
use Livewire\Form;

class PointForm extends Form
{
    public ?Point $point;

    public $point_id;
    public $name;

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

    public function delete()
    {
        $point = Point::findOrFail($this->point_id);
        $point->edokis()->update(['point_id' => null]);
        $point->emadEdeens()->update(['point_id' => null]);
        $point->delete();
    }
}
