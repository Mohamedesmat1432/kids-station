<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteDepartment extends Component
{
    use WithNotify;

    public DepartmentForm $form;
    public $bulk_delete_modal = false;
    public $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->form->checkbox_arr = explode(',', $arr);
        $this->count = count($this->form->checkbox_arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->form->bulkDelete();
        $this->dispatch('bulk-delete-department');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('Departments deleted successfully'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.department.bulk-delete-department');
    }
}
