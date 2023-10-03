<?php

namespace App\Livewire\Patch;

use App\Livewire\Forms\PatchForm;
use App\Models\PatchBranch;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdatePatch extends Component
{
    use WithNotify;

    public PatchForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(PatchBranch $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setPatch($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-patch');
        $this->successNotify(__('Patch updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.patch.update-patch');
    }
}
