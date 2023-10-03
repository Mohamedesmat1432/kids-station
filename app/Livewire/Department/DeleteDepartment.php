<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteDepartment extends Component
{
    use WithNotify;

    public DepartmentForm $form;

    public $delete_modal = false;

    #[On('delete-modal')]
    public function confirmDelete(Department $id)
    {
        $this->form->setDepartment($id);
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete();
        $this->dispatch('delete-department');
        $this->successNotify(__('Department deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.department.delete-department');
    }
}
