<?php

namespace App\Traits;

use App\Models\Role;
use Livewire\WithPagination;

trait RoleTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait;

    public ?Role $role;
    public $role_id;
    public $name;
    public $permission;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:roles,name,' . $this->role_id,
            'permission' => 'required',
        ];
    }

    public function setRole($id)
    {
        $this->role = Role::findOrFail($id);
        $this->role_id = $this->role->id;
        $this->name = $this->role->name;
        $this->permission = $this->role->permissions->pluck('id');
    }

    public function storeRole()
    {
        $this->authorize('create-role');
        $validated = $this->validate();
        $role = Role::create($validated);
        $role->givePermissionTo($this->permission);
        $this->reset();
        $this->dispatch('refresh-list-role');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.role_created'));
        $this->create_modal = false;
    }

    public function updateRole()
    {
        $this->authorize('edit-role');
        $validated = $this->validate();
        $this->role->update($validated);
        $this->role->syncPermissions($this->permission);
        $this->reset();
        $this->dispatch('refresh-list-role');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.role_updated'));
        $this->edit_modal = false;
    }

    public function deleteRole($id)
    {
        $this->authorize('delete-role');
        $role = Role::findOrFail($id);
        $role->delete();
        $this->reset();
        $this->dispatch('refresh-list-role');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.role_deleted'));
        $this->delete_modal = false;
    }

    public function bulkDeleteRole()
    {
        $roles = Role::whereIn('id', $this->checkbox_arr);
        $roles->delete();
        $this->reset();
    }
}
