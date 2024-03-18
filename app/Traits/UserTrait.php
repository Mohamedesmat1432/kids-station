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
        $this->authorize('create-user');
        $validated = $this->validate();
        $validated['password'] = Hash::make($this->password);
        $user = User::create($validated);
        $user->syncRoles($this->role);
        $this->reset();
        $this->dispatch('refresh-list-user');
        $this->successNotify(__('site.user_created'));
        $this->create_modal = false;
    }

    public function updateUser()
    {
        $this->authorize('edit-user');
        $validated = $this->validate();
        $this->user->syncRoles($this->role);
        $this->user->update($validated);
        $this->dispatch('refresh-list-user');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.user_updated'));
        $this->edit_modal = false;
    }

    public function deleteUser($id)
    {
        $this->authorize('delete-user');
        $user = User::findOrFail($id);
        $user->delete();
        $this->dispatch('refresh-list-user');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('User deleted successfully'));
        $this->delete_modal = false;
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

    public function userList()
    {
        $this->authorize('view-user');

        return User::orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->search($this->search)->paginate($this->page_element);
    }
}
