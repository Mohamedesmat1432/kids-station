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

        $roles = $this->roleList();

        return view('livewire.role.list-role', [
            'roles' => $roles,
        ]);
    }
}
