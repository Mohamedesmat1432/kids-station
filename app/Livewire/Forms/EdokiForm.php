<?php

namespace App\Livewire\Forms;

use App\Models\Edoki;
use Livewire\Form;

class EdokiForm extends Form
{
    public ?Edoki $edoki;
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
    public $checkbox_arr = [];

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

    protected $validationAttributes = [
        'name' => 'Name',
        'email' => 'Email',
        'port' => 'Port',
        'department_id' => 'Department Id',
        'device_id' => 'Device Id',
        'ip_id' => 'Ip Id',
        'switch_id' => 'Switch Id',
        'patch_id' => 'Patch Id',
        'point_id' => 'Point Id',
    ];

    public function setSchema(Edoki $edoki)
    {
        $this->edoki = $edoki;
        $this->edoki_id = $edoki->id;
        $this->name = $edoki->name;
        $this->email = $edoki->email;
        $this->department_id = $edoki->department_id;
        $this->device_id = $edoki->device_id;
        $this->ip_id = $edoki->ip_id;
        $this->switch_id = $edoki->switch_id;
        $this->patch_id = $edoki->patch_id;
        $this->point_id = $edoki->point_id;
        $this->port = $edoki->port;
    }

    public function store()
    {
        $validated = $this->validate();
        Edoki::create($validated);
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();
        $this->edoki->update($validated);
    }

    public function delete()
    {
        $edoki = Edoki::findOrFail($this->edoki_id);
        $edoki->delete();
    }

    public function checkboxAll()
    {
        $data = Edoki::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDelete()
    {
        $edokis = Edoki::whereIn('id', $this->checkbox_arr);
        $edokis->delete();
    }
}
