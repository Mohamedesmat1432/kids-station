<?php

namespace App\Livewire\Switch;

use App\Livewire\Forms\SwitchForm;
use App\Models\SwitchBranch;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteSwitch extends Component
{
    use WithNotify;

    public SwitchForm $form;

    public $delete_modal = false;

    #[On('delete-modal')]
    public function confirmDelete(SwitchBranch $id)
    {
        $this->form->setSwitch($id);
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete();
        $this->dispatch('delete-switch');
        $this->successNotify(__('Switch deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.switch.delete-switch');
    }
}
