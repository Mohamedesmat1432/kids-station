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

    public function delete()
    {
        $user = User::findOrFail($this->user_id);
        $user->delete();
    }
}
