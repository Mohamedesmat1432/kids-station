<?php

namespace App\Traits;

use Livewire\WithPagination;

trait SwitchTrait
{
    use WithPagination, FileTrait, ConfirmTrait, SortSearchTrait, MessageTrait;

    public $switch_id;
    public $hostname;
    public $ip;
    public $platform;
    public $version;
    public $floor;
    public $location;
    public $password;
    public $password_enable;
    public $selected_switch = [];
    public $bulk_disabled = false;

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
