<?php

namespace App\Traits;

use Livewire\WithPagination;

trait SwitchTrait
{
    use WithPagination, FileTrait, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $switch_id, $hostname, $ip, $platform, $version, $floor, $location, $password, $password_enable;

    protected function rules()
    {
        return [
            'hostname' => 'required|string|min:2|unique:switch_branchs,hostname,' . $this->switch_id,
            'ip' => 'required|string|min:2|unique:switch_branchs,ip,' . $this->switch_id,
            'platform' => 'nullable|string|min:2',
            'version' => 'nullable|string|min:2',
            'floor' => 'nullable|string|min:2',
            'location' => 'nullable|string|min:2',
            'password' => 'nullable|string|min:2',
            'password_enable' => 'nullable|string|min:2',
        ];
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}
