<?php

namespace App\Traits;

use Livewire\WithPagination;

trait PermissionTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $permission_id, $name;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:permissions,name,' . $this->permission_id,
        ];
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}
