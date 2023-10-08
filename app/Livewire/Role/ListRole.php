<?php

namespace App\Livewire\Role;

use App\Models\Role;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListRole extends Component
{
    use WithPagination, SortSearchTrait;

    #[On('create-role')]
    #[On('update-role')]
    #[On('delete-role')]
    public function render()
    {
        $this->authorize('view-role');

        $roles = Role::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.role.list-role', [
            'roles' => $roles
        ]);
    }
}
