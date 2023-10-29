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

    #[Locked]
    public $id, $port;

    #[On('delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->port = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete($this->id);
        $this->dispatch('delete-patch');
        $this->successNotify(__('Patch deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.patch.delete-patch');
    }
}
