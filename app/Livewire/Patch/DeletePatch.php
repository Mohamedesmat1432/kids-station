<?php

namespace App\Livewire\Patch;

use App\Livewire\Forms\PatchForm;
use App\Models\PatchBranch;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeletePatch extends Component
{
    use WithNotify;

    public PatchForm $form;

    public $delete_modal = false;

    #[On('delete-modal')]
    public function confirmDelete(PatchBranch $id)
    {
        $this->form->setPatch($id);
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete();
        $this->dispatch('delete-patch');
        $this->successNotify(__('Patch deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.patch.delete-patch');
    }
}
