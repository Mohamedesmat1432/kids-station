<?php

namespace App\Livewire\Forms;

use App\Models\Role;
use Livewire\Form;

class RoleForm extends Form
{
    public ?Role $role;
    public $role_id;
    public $name;
    public $permission;
    public $checkbox_arr = [];

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:roles,name,' . $this->role_id,
            'permission' => 'required'
        ];
    }

    protected $validationAttributes = [
        'name' => 'Name',
        'permission' => 'Permission',
    ];

    public function setRole(Role $role)
    {
        $this->role = $role;
        $this->role_id = $role->id;
        $this->name = $role->name;
        $this->permission = $role->permissions->pluck('id');
    }

    public function store()
    {
        $validated = $this->validate();
        $role = Role::create($validated);
        $role->syncPermissions($this->permission);
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();
        $this->role->update($validated);
        $this->role->syncPermissions($this->permission);
    }

    public function delete($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
    }

    public function checkboxAll()
    {
        $data = Role::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDelete()
    {
        $roles = Role::whereIn('id', $this->checkbox_arr);
        $roles->delete();
    }
}
