<?php

namespace App\Livewire\User;

use App\Models\User;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListUser extends Component
{
    use WithPagination, SortSearchTrait;

    #[On('create-user')]
    #[On('update-user')]
    #[On('delete-user')]
    public function render()
    {
        $this->authorize('view-user');

        $users = User::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate($this->page_element);

        return view('livewire.user.list-user', [
            'users' => $users
        ]);
    }
}
