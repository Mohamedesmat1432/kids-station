<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Traits\UserTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListUser extends Component
{
    use UserTrait;

    #[On('refresh-list-user')]
    public function render()
    {
        $this->authorize('view-user');

        $users = $this->userList();

        return view('livewire.user.list-user', [
            'users' => $users,
        ]);
    }
}
