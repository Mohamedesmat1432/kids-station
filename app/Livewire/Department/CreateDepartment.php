<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Traits\WithNotify;
use Livewire\Component;

class CreateDepartment extends Component
{
    use WithNotify;

    public DepartmentForm $form;

    public $create_modal = false;

    public function createModal()
    {
        $this->form->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->form->store();
        $this->dispatch('create-department');
        $this->successNotify(__('Department created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        return view('livewire.department.create-department');
    }
}
