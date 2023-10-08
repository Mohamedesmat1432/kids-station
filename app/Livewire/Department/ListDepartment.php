<?php

namespace App\Livewire\Department;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListDepartment extends Component
{
    use WithPagination, SortSearchTrait;

    public DepartmentForm $form;

    public function checkboxAll()
    {
        $this->form->checkboxAll();
    }

    #[On('bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->form->checkbox_arr = [];
    }

    #[On('create-department')]
    #[On('update-department')]
    #[On('delete-department')]
    #[On('bulk-delete-department')]
    public function render()
    {
        $this->authorize('view-department');

        $departments = Department::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.department.list-department', [
            'departments' => $departments
        ]);
    }
}
