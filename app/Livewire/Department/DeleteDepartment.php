<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteDepartment extends Component
{
    use WithNotify;

    public DepartmentForm $form;

    public $delete_modal = false;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id,$name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete($this->id);
        $this->dispatch('delete-department');
        $this->successNotify(__('Department deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.department.delete-department');
    }
}
