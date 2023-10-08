<?php

namespace App\Livewire\Forms;

use App\Models\EmadEdeen;
use Livewire\Form;

class EmadEdeenForm extends Form
{
    public ?EmadEdeen $emad_edeen;
    public $emad_edeen_id;
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
            'email' => 'required|string|email|max:255|unique:emad_edeens,email,' . $this->emad_edeen_id,
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

    public function setSchema(EmadEdeen $emad_edeen)
    {
       $this->emad_edeen = $emad_edeen;
       $this->emad_edeen_id = $emad_edeen->id;
       $this->name = $emad_edeen->name;
       $this->email = $emad_edeen->email;
       $this->department_id = $emad_edeen->department_id;
       $this->device_id = $emad_edeen->device_id;
       $this->ip_id = $emad_edeen->ip_id;
       $this->switch_id = $emad_edeen->switch_id;
       $this->patch_id = $emad_edeen->patch_id;
       $this->point_id = $emad_edeen->point_id;
       $this->port = $emad_edeen->port;
    }

    public function store()
    {
        $validated = $this->validate();
        EmadEdeen::create($validated);
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();
        $this->emad_edeen->update($validated);
    }

    public function delete()
    {
        $emad_edeen = EmadEdeen::findOrFail($this->emad_edeen_id);
        $emad_edeen->delete();
    }

    public function checkboxAll()
    {
        if (empty($this->checkbox_arr)) {
            $this->checkbox_arr = EmadEdeen::pluck('id')->toArray();
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDelete()
    {
        $emad_edeens = EmadEdeen::whereIn('id', $this->checkbox_arr);
        $emad_edeens->delete();
    }
}
