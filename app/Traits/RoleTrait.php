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
    public $checkbox_arr = [];

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
        $validated = $this->validate();
        $role = Role::create($validated);
        $role->givePermissionTo($this->permission);
        $this->reset();
    }

    public function updateRole()
    {
        $validated = $this->validate();
        $this->role->update($validated);
        $this->role->syncPermissions($this->permission);
    }

    public function deleteRole($id)
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

    public function bulkDeleteRole()
    {
        $roles = Role::whereIn('id', $this->checkbox_arr);
        $roles->delete();
    }

    public function roleList()
    {
        return cache()->remember('roles', 1, function () {
            return Role::when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }
}
