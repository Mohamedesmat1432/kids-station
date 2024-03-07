<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

trait UserTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait;

    public ?User $user;
    public $user_id;
    public $name;
    public $email;
    public $password;
    public $role;
    public $checkbox_arr = [];

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|min:4',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user_id,
            'role' => 'nullable|exists:roles,id',
        ];

        if (!$this->user_id) {
            $rules['password'] = 'required|string|min:8';
        }

        return $rules;
    }

    public function setUser($id)
    {
        $this->user = User::findOrFail($id);
        $this->user_id = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role =  $this->user->roles->pluck('id');
    }

    public function storeUser()
    {
        $validated = $this->validate();
        $validated['password'] = Hash::make($this->password);
        $user = User::create($validated);
        $user->syncRoles($this->role);
        $this->reset();
    }

    public function updateUser()
    {
        $validated = $this->validate();
        $this->user->syncRoles($this->role);
        $this->user->update($validated);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }

    public function checkboxAll()
    {
        $data = User::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteUser()
    {
        $users = User::whereIn('id', $this->checkbox_arr);
        $users->delete();
    }

    public function userList()
    {
        return cache()->remember('users', 1, function () {
            return User::when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }
}
