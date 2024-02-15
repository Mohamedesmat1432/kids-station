<?php

namespace App\Livewire\Role;

use App\Models\Permission;
use App\Traits\RoleTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateRole extends Component
{
    use RoleTrait;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setRole($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->authorize('edit-role');
        $this->updateRole();
        $this->dispatch('refresh-list-role');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.role_updated'));
        $this->edit_modal = false;
    }

    public function render()
    {
        $permissions = Permission::pluck('name', 'id');

        return view('livewire.role.update-role', [
            'permissions' => $permissions
        ]);
    }
}
