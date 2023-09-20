<?php

namespace App\Traits;

use Livewire\WithPagination;

trait RoleTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $role_id, $name;
    public $permission;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:roles,name,' . $this->role_id,
            'permission' => 'required'
        ];
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}
