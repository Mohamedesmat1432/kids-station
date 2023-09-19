<?php

namespace App\Livewire\Department;

use App\Models\Department;
use App\Traits\DepartmentTrait;
use Livewire\Component;

class DepartmentComponent extends Component
{
    use DepartmentTrait;

    protected $queryString = [
        'search' => ['except' => ''],
        'sort_by' => ['except' => 'id'],
        'sort_asc' => ['except' => true]
    ];

    public function render()
    {
        $departments = Department::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.department.department-component', [
            'departments' => $departments
        ]);
    }

    public function confirmDepartmentAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }

    public function confirmDepartmentEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $department = Department::findOrFail($id);
        $this->department_id = $department->id;
        $this->name = $department->name;
    }

    public function saveDepartment()
    {
        $validated = $this->validate();
        if (isset($this->department_id)) {
            $department = Department::findOrFail($this->department_id);
            $department->update($validated);
            $this->successMessage(__('Department updated successfully'));
        } else {
            Department::create($validated);
            $this->successMessage(__('Department created successfully'));
        }
        $this->confirm_form = false;
    }

    public function confirmDepartmentDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function deleteDepartment()
    {
        $department = Department::findOrFail($this->confirm_delete);
        $department->edokis()->update(['department_id' => null]);
        $department->emadEdeens()->update(['department_id' => null]);
        $department->delete();
        $this->successMessage(__('Department deleted successfully'));
        $this->confirm_delete = false;
    }
}
