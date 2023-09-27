<?php

namespace App\Traits;

use Livewire\WithPagination;

trait EdokiTrait
{
    use WithPagination, ConfirmTrait, SortSearchTrait, MessageTrait, FileTrait;

    public $edoki_id;
    public $name;
    public $email;
    public $port;
    public $department_id;
    public $device_id;
    public $ip_id;
    public $switch_id;
    public $patch_id;
    public $point_id;

    protected function rules()
    {
        $rules = [
            'name' => 'required|string|min:4',
            'email' => 'required|string|email|max:255|unique:edokis,email,' . $this->edoki_id,
            'port' => 'nullable|numeric',
            'department_id' => 'nullable|numeric|exists:departments,id',
            'device_id' => 'nullable|numeric|exists:devices,id',
            'ip_id' => 'nullable|numeric|exists:ips,id',
            'switch_id' => 'nullable|numeric|exists:switch_branchs,id',
            'patch_id' => 'nullable|numeric|exists:patch_branchs,id',
            'point_id' => 'nullable|numeric|exists:points,id',
        ];

        return $rules;
    }

    public function resetItems()
    {
        $this->reset();
        $this->resetValidation();
    }
}
