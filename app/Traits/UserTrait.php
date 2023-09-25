<?php

namespace App\Traits;

use Livewire\WithPagination;

trait UserTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $user_id, $name, $email, $password;
    public $role;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|min:4',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user_id,
            'role' => 'required',
        ];

        if (!$this->user_id) {
            $rules['password'] = 'required|string|min:8';
        }

        return $rules;
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}
