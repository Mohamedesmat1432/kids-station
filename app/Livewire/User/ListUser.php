<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Traits\UserTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListUser extends Component
{
    use UserTrait;

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
        $this->checkbox_status = false;
    }
    
    #[On('refresh-list-user')]
    public function render()
    {
        $this->authorize('view-user');

        $users = $this->trash ? User::onlyTrashed() : User::withoutTrashed();

        $users = $users->search($this->search)
            ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        $this->checkbox_all = $users->pluck('id')->toArray();

        return view('livewire.user.list-user', [
            'users' => $users,
        ]);
    }
}
