<?php

namespace App\Livewire\Switch;

use App\Livewire\Forms\SwitchForm;
use App\Models\SwitchBranch;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateSwitch extends Component
{
    use WithNotify;

    public SwitchForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(SwitchBranch $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setSwitch($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-switch');
        $this->successNotify(__('Switch updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.switch.update-switch');
    }
}
