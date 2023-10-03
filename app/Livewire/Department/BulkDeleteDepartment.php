<?php

namespace App\Livewire\Department;

use App\Models\Department;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteDepartment extends Component
{
    use WithNotify;

    public $bulk_delete_modal = false;
    public $arr = [], $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->arr = explode(',', $arr);
        $this->count = count($this->arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $companies = Department::whereIn('id', $this->arr);
        $companies->delete();
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
