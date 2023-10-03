<?php

namespace App\Livewire\EmadEdeen;

use App\Livewire\Forms\EmadEdeenForm;
use App\Models\Department;
use App\Models\Device;
use App\Models\Ip;
use App\Models\PatchBranch;
use App\Models\Point;
use App\Models\SwitchBranch;
use App\Traits\WithNotify;
use Livewire\Component;

class CreateSchema extends Component
{
    use WithNotify;

    public EmadEdeenForm $form;

    public $create_modal = false;

    public function createModal()
    {
        $this->form->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->form->store();
        $this->dispatch('create-schema');
        $this->successNotify(__('Schema created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        $departments = Department::pluck('name', 'id');
        $devices = Device::pluck('name', 'id');
        $ips = Ip::pluck('number', 'id');
        $patchs = PatchBranch::pluck('port', 'id');
        $switchs = SwitchBranch::pluck('hostname', 'id');
        $points = Point::pluck('name', 'id');

        return view('livewire.emad-edeen.create-schema',[
            'departments' => $departments,
            'devices' => $devices,
            'ips' => $ips,
            'patchs' => $patchs,
            'switchs' => $switchs,
            'points' => $points
        ]);
    }
}
