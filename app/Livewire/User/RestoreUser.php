<?php

namespace App\Livewire\User;

use App\Traits\UserTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class RestoreUser extends Component
{
    use UserTrait;

    #[Locked]
    public $id, $name;

    #[On('restore-modal')]
    public function confirmRestore($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->restore_modal = true;
    }

    public function restore()
    {
        $this->restoreUser($this->id);
    }

    public function render()
    {
        return view('livewire.user.restore-user');
    }
}
