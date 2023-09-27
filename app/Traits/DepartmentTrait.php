<?php

namespace App\Traits;

use Livewire\WithPagination;

trait DepartmentTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $department_id;
    public $name;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:departments,name,' . $this->department_id
        ];
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}
