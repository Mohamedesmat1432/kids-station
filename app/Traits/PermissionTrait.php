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
    public $checkbox_arr = [];

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
        $validated = $this->validate();
        Permission::create($validated);
        $this->reset();
    }

    public function updatePermission()
    {
        $validated = $this->validate();
        $this->permission->update($validated);
    }

    public function deletePermission($id)
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

    public function bulkDeletePermission()
    {
        $permissions = Permission::whereIn('id', $this->checkbox_arr);
        $permissions->delete();
    }

    public function permissionList()
    {
        return Permission::orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->search($this->search)->paginate($this->page_element);
    }
}
