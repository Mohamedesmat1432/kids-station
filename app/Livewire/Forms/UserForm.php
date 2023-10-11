<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Form;

class UserForm extends Form
{
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

    protected $validationAttributes = [
        'name' => 'Name',
        'email' => 'Email',
        'role' => 'Role',
        'password' => 'Password',
    ];

    public function setUser(User $user)
    {
        $this->user = $user;
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role =  $user->roles->pluck('id');
    }

    public function store()
    {
        $validated = $this->validate();
        $validated['password'] = Hash::make($this->password);
        $user = User::create($validated);
        $user->syncRoles($this->role);
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();
        $this->user->syncRoles($this->role);
        $this->user->update($validated);
    }

    public function delete($id)
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

    public function bulkDelete()
    {
        $users = User::whereIn('id', $this->checkbox_arr);
        $users->delete();
    }
}
