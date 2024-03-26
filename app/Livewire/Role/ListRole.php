<?php

namespace App\Livewire\Role;

use App\Models\Role;
use App\Traits\RoleTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListRole extends Component
{
    use RoleTrait;

    #[On('refresh-list-role')]
    public function render()
    {
        $this->authorize('view-role');

        $roles =  Role::orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->search($this->search)->paginate($this->page_element);

        return view('livewire.role.list-role', [
            'roles' => $roles,
        ]);
    }
}
