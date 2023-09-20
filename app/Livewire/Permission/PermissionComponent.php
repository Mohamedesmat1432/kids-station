<?php

namespace App\Livewire\Permission;

use App\Models\Permission;
use App\Traits\PermissionTrait;
use Livewire\Component;

class PermissionComponent extends Component
{
    use PermissionTrait;

    public function render()
    {
        $this->authorize('view-permission');

        $permissions = Permission::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.permission.permission-component', [
            'permissions' => $permissions
        ]);
    }

    public function confirmPermissionAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }

    public function confirmPermissionEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $permission = Permission::findOrFail($id);
        $this->permission_id = $permission->id;
        $this->name = $permission->name;
    }

    public function savePermission()
    {
        $validated = $this->validate();
        if (isset($this->permission_id)) {
            $permission = Permission::findOrFail($this->permission_id);
            $permission->update($validated);
            $this->successMessage(__('Permission updated successfully'));
        } else {
            Permission::create($validated);
            $this->successMessage(__('Permission created successfully'));
        }

        $this->confirm_form = false;
    }

    public function confirmPermissionDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function deletePermission()
    {
        $permission = Permission::findOrFail($this->confirm_delete);
        $permission->delete();
        $this->successMessage(__('Permission deleted successfully'));
        $this->confirm_delete = false;
    }
}
