<?php

namespace App\Livewire\User;

use App\Traits\UserTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceDeleteUser extends Component
{
    use UserTrait;

    #[Locked]
    public $id, $name;

    #[On('force-delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->force_delete_modal = true;
    }

    public function delete()
    {
        $this->forceDeleteUser($this->id);
    }

    public function render()
    {
        return view('livewire.user.force-delete-user');
    }
}
