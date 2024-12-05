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
    public $new_password;
    public $role;
    protected function rules()
    {
        $rules = [
            'name' => 'required|string|min:4',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->user_id,
            'role' => 'nullable|exists:roles,id',
            'status' => 'required|boolean',
        ];

        if($this->password) {
            $rules['password'] = 'required|string|min:8';
        }

        if($this->new_password) {
            $rules['new_password'] = 'required|string|min:8';
        }

        return $rules;
    }

    public function setUser($id)
    {
        $this->user = User::findOrFail($id);
        $this->user_id = $this->user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->status = $this->user->status;
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
        if($this->new_password) {
            $validated['password'] = Hash::make($this->new_password);
        }
        $this->user->syncRoles($this->role);
        $this->user->update($validated);
        $this->reset();
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
        $this->reset();
        $this->dispatch('refresh-list-user');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.user_deleted'));
        $this->delete_modal = false;
    }

    public function bulkDeleteUser($arr)
    {
        $this->authorize('bulk-delete-user');
        $users = User::withoutTrashed()->whereIn('id', $arr);
        $users->delete();
        $this->reset();
        $this->dispatch('refresh-list-user');
        $this->dispatch('checkbox-clear');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.user_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function restoreUser($id)
    {
        $this->authorize('restore-user');
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        $this->reset();
        $this->dispatch('refresh-list-user');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.user_restored'));
        $this->restore_modal = false;
    }

    public function forceDeleteUser($id)
    {
        $this->authorize('force-delete-user');
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-user');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.user_deleted'));
        $this->force_delete_modal = false;
    }

    public function forceBulkDeleteUser($arr)
    {
        $this->authorize('force-bulk-delete-user');
        $users = User::onlyTrashed()->whereIn('id', $arr);
        $users->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-user');
        $this->dispatch('checkbox-clear');
        $this->dispatch('refresh-navigation-menu');
        $this->successNotify(__('site.user_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
}
