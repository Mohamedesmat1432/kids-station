<?php

namespace App\Livewire\Permission;

use App\Models\Permission;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListPermission extends Component
{
    use WithPagination, SortSearchTrait;

    #[On('create-permission')]
    #[On('update-permission')]
    #[On('delete-permission')]
    public function render()
    {
        $this->authorize('view-permission');

        $permissions = Permission::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.permission.list-permission', [
            'permissions' => $permissions
        ]);
    }
}
