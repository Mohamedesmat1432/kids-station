<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use Livewire\Form;

class DepartmentForm extends Form
{
    public ?Department $department;
    public $department_id;
    public $name;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:departments,name,' . $this->department_id
        ];
    }

    protected $validationAttributes = [
        'name' => 'Name',
    ];

    public function store()
    {
        $validated = $this->validate();
        Department::create($validated);
        $this->reset();
    }

    public function setDepartment(Department $department)
    {
        $this->department = $department;
        $this->department_id = $department->id;
        $this->name = $department->name;
    }

    public function update()
    {
        $validated = $this->validate();
        $this->department->update($validated);
    }

    public function delete()
    {
        $department = Department::findOrFail($this->department_id);
        $department->edokis()->update(['department_id' => null]);
        $department->emadEdeens()->update(['department_id' => null]);
        $department->delete();
    }
}
