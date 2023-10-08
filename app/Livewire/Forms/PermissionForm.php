<?php

namespace App\Livewire\Forms;

use App\Models\Permission;
use Livewire\Form;

class PermissionForm extends Form
{
    public ?Permission $permission;
    public $permission_id;
    public $name;
    public $checkbox_arr = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:permissions,name,' . $this->permission_id,
        ];
    }

    protected $validationAttributes = [
        'name' => 'Name',
    ];

    public function setPermission(Permission $permission)
    {
        $this->permission = $permission;
        $this->permission_id = $permission->id;
        $this->name = $permission->name;
    }

    public function store()
    {
        $validated = $this->validate();
        Permission::create($validated);
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();
        $this->permission->update($validated);
    }

    public function delete()
    {
        $permission = Permission::findOrFail($this->permission_id);
        $permission->delete();
    }

    public function checkboxAll()
    {
        if (empty($this->checkbox_arr)) {
            $this->checkbox_arr = Permission::pluck('id')->toArray();
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDelete()
    {
        $permissions = Permission::whereIn('id', $this->checkbox_arr);
        $permissions->delete();
    }
}
