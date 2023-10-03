<?php

namespace App\Livewire\Ip;

use App\Livewire\Forms\IpForm;
use App\Models\Ip;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateIp extends Component
{
    use WithNotify;

    public IpForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(Ip $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setIp($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-ip');
        $this->successNotify(__('Ip updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.ip.update-ip');
    }
}
