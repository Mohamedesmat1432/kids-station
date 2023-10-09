<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use Livewire\Form;

class DepartmentForm extends Form
{
    public ?Department $department;
    public $department_id;
    public $name;
    public $checkbox_arr = [];

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

    public function checkboxAll()
    {
        $data = Department::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDelete()
    {
        $departments = Department::whereIn('id', $this->checkbox_arr);

        foreach ($departments as $department) {
            $department->edokis()->update(['department_id' => null]);
            $department->emadEdeens()->update(['department_id' => null]);
        }

        $departments->delete();
    }
}
