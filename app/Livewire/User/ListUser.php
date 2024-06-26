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

        $users = User::search($this->search)
            ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        return view('livewire.user.list-user', [
            'users' => $users,
        ]);
    }
}
