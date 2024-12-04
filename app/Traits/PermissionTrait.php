<?php

namespace App\Traits;

use App\Models\Permission;
use Livewire\WithPagination;

trait PermissionTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait;

    public ?Permission $permission;
    public $permission_id;
    public $name;

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:permissions,name,' . $this->permission_id,
        ];
    }

    public function setPermission($id)
    {
        $this->permission = Permission::findOrFail($id);
        $this->permission_id = $this->permission->id;
        $this->name = $this->permission->name;
    }

    public function storePermission()
    {
        $this->authorize('create-permission');
        $validated = $this->validate();
        Permission::create($validated);
        $this->reset();
        $this->dispatch('refresh-list-permission');
        $this->successNotify(__('site.permission_created'));
        $this->create_modal = false;
    }

    public function updatePermission()
    {
        $this->authorize('edit-permission');
        $validated = $this->validate();
        $this->permission->update($validated);
        $this->reset();
        $this->dispatch('refresh-list-permission');
        $this->successNotify(__('site.permission_updated'));
        $this->edit_modal = false;
    }

    public function deletePermission($id)
    {
        $this->authorize('delete-permission');
        $permission = Permission::findOrFail($id);
        $permission->delete();
        $this->reset();
        $this->dispatch('refresh-list-permission');
        $this->successNotify(__('site.permission_deleted'));
        $this->delete_modal = false;
    }

    public function bulkDeletePermission($arr)
    {
        $permissions = Permission::whereIn('id', $arr);
        $permissions->delete();
        $this->reset();
    }
}
