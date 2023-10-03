<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateDepartment extends Component
{
    use WithNotify;

    public DepartmentForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(Department $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setDepartment($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-department');
        $this->successNotify(__('Department updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.department.update-department');
    }
}
