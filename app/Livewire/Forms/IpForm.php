<?php

namespace App\Livewire\Forms;

use App\Models\Ip;
use Livewire\Form;

class IpForm extends Form
{
    public ?Ip $ip;
    public $ip_id;
    public $number;

    protected function rules()
    {
        return [
            'number' => 'required|string|min:2|unique:ips,number,' . $this->ip_id,
        ];
    }

    protected $validationAttributes = [
        'number' => 'Number'
    ];

    public function setIp(Ip $ip)
    {
        $this->ip = $ip;
        $this->ip_id = $ip->id;
        $this->number = $ip->number;
    }

    public function store()
    {
        $validated = $this->validate();
        Ip::create($validated);
        $this->reset();
    }

    public function update()
    {
        $validated = $this->validate();
        $this->ip->update($validated);
    }

    public function delete()
    {
        $ip = Ip::findOrFail($this->ip_id);
        $ip->edokis()->update(['ip_id' => null]);
        $ip->emadEdeens()->update(['ip_id' => null]);
        $ip->delete();
    }
}
