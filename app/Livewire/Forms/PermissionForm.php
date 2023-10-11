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

    public function delete($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
    }

    public function checkboxAll()
    {
        $data = Permission::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
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
