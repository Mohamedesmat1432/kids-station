<?php

namespace App\Livewire\EmadEdeen;

use App\Livewire\Forms\EmadEdeenForm;
use App\Models\Department;
use App\Models\Device;
use App\Models\EmadEdeen;
use App\Models\Ip;
use App\Models\PatchBranch;
use App\Models\Point;
use App\Models\SwitchBranch;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateSchema extends Component
{
    use WithNotify;

    public EmadEdeenForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(EmadEdeen $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setSchema($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-schema');
        $this->successNotify(__('Schema updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        $departments = Department::pluck('name', 'id');
        $devices = Device::pluck('name', 'id');
        $ips = Ip::pluck('number', 'id');
        $patchs = PatchBranch::pluck('port', 'id');
        $switchs = SwitchBranch::pluck('hostname', 'id');
        $points = Point::pluck('name', 'id');

        return view('livewire.emad-edeen.update-schema',[
            'departments' => $departments,
            'devices' => $devices,
            'ips' => $ips,
            'patchs' => $patchs,
            'switchs' => $switchs,
            'points' => $points
        ]);
    }
}
