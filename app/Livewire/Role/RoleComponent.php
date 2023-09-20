<?php

namespace App\Livewire\Role;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\RoleTrait;
use Livewire\Component;

class RoleComponent extends Component
{
    use RoleTrait;

    public function render()
    {
        $this->authorize('view-role');

        $roles = Role::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        $permissions = Permission::pluck('name','id');

        return view('livewire.role.role-component', [
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function confirmRoleAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }

    public function confirmRoleEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $role = Role::findOrFail($id);
        $this->role_id = $role->id;
        $this->name = $role->name;
        $this->permission = $role->permissions->pluck('id');
    }

    public function saveRole()
    {
        $validated = $this->validate();
        if (isset($this->role_id)) {
            $role = Role::findOrFail($this->role_id);
            $role->syncPermissions($this->permission);
            $role->update($validated);
            $this->successMessage(__('Role updated successfully'));

        } else {
            $role = Role::create($validated);
            $role->syncPermissions($this->permission);
            $this->successMessage(__('Role created successfully'));
        }

        $this->confirm_form = false;
    }

    public function confirmRoleDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function deleteRole()
    {
        $role = Role::findOrFail($this->confirm_delete);
        $role->delete();
        $this->successMessage(__('Role deleted successfully'));
        $this->confirm_delete = false;
    }
}
