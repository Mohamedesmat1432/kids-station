<?php

namespace App\Livewire\Permission;

use App\Models\Permission;
use App\Traits\PermissionTrait;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListPermission extends Component
{
    use WithPagination, SortSearchTrait, PermissionTrait;

    #[On('create-permission')]
    #[On('update-permission')]
    #[On('delete-permission')]
    public function render()
    {
        $this->authorize('view-permission');

        $permissions = cache()->remember('permissions', 1, function () {
            return Permission::when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });

        return view('livewire.permission.list-permission', [
            'permissions' => $permissions,
        ]);
    }
}
