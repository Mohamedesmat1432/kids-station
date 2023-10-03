<?php

namespace App\Livewire\Patch;

use App\Livewire\Forms\PatchForm;
use App\Traits\WithNotify;
use Livewire\Component;

class CreatePatch extends Component
{
    use WithNotify;

    public PatchForm $form;

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
        $this->dispatch('create-patch');
        $this->successNotify(__('Patch created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        return view('livewire.patch.create-patch');
    }
}
