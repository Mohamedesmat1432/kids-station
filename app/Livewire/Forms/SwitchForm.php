<?php

namespace App\Livewire\Forms;

use App\Models\SwitchBranch;
use Livewire\Form;

class SwitchForm extends Form
{
    public ?SwitchBranch $switch;
    public $switch_id;
    public $hostname;
    public $ip;
    public $platform;
    public $version;
    public $floor;
    public $location;
    public $password;
    public $password_enable;
    public $checkbox_arr = [];

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

    protected $validationAttributes = [
        'hostname' => 'HostName',
        'ip' => 'Ip',
        'platform' => 'Platform',
        'version' => 'Version',
        'floor' => 'Floor',
        'location' => 'Location',
        'password' => 'Password',
        'password_enable' => 'Password Enable',
    ];

    public function setSwitch(SwitchBranch $switch)
    {
        $this->switch = $switch;
        $this->switch_id = $switch->id;
        $this->hostname = $switch->hostname;
        $this->ip = $switch->ip;
        $this->platform = $switch->platform;
        $this->version = $switch->version;
        $this->floor = $switch->floor;
        $this->location = $switch->location;
        $this->password = $switch->password;
        $this->password_enable = $switch->password_enable;
    }

    public function store()
    {
        $validated = $this->validate();
        SwitchBranch::create($validated);
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();
        $this->switch->update($validated);
    }


    public function delete()
    {
        $switch = SwitchBranch::findOrFail($this->switch_id);
        $switch->edokis()->update(['switch_id' => null]);
        $switch->emadEdeens()->update(['switch_id' => null]);
        $switch->delete();
    }

    public function checkboxAll()
    {
        if (empty($this->checkbox_arr)) {
            $this->checkbox_arr = SwitchBranch::pluck('id')->toArray();
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDelete()
    {
        $switchs = SwitchBranch::whereIn('id', $this->checkbox_arr);

        foreach ($switchs as $switch) {
            $switch->edokis()->update(['switch_id' => null]);
            $switch->emadEdeens()->update(['switch_id' => null]);
        }
        $switchs->delete();
    }
}
