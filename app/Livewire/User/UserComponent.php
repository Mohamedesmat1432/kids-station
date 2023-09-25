<?php

namespace App\Livewire\User;

use App\Models\Department;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Traits\UserTrait;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserComponent extends Component
{
    use UserTrait;

    public function render()
    {
        $this->authorize('view-user');
        
        $roles = Role::pluck('name','id');

        $users = User::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')->paginate(10);

        return view('livewire.user.user-component', [
            'users' => $users,
            'roles' => $roles
        ]);
    }

    public function confirmUserAdd()
    {
        $this->resetItems();
        $this->confirm_form = true;
    }


    public function confirmUserEdit($id)
    {
        $this->resetItems();
        $this->confirm_form = true;
        $user = User::findOrFail($id);
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->roles->pluck('id');
    }

    public function saveUser()
    {
        $validated = $this->validate();
        if (isset($this->user_id)) {
            $user = User::findOrFail($this->user_id);
            $user->syncRoles($this->role);
            $user->update($validated);
            $this->dispatch('refresh-navigation-menu');
            $this->successMessage(__('User updated succssfully'));
        } else {
            $validated['password'] = Hash::make($this->password);
            $user = User::create($validated);
            $user->syncRoles($this->role);
            $this->successMessage(__('User created succssfully'));
        }

        $this->confirm_form = false;
    }

    public function confirmUserDeletion($id)
    {
        $this->confirm_delete = $id;
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->confirm_delete);
        $user->delete();
        $this->successMessage(__('User deleted succssfully'));
        $this->confirm_delete = false;
    }
}
