<?php

namespace App\Livewire\EmadEdeen;

use App\Livewire\Forms\EmadEdeenForm;
use App\Models\EmadEdeen;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteSchema extends Component
{
    use WithNotify;
    public EmadEdeenForm $form;

    public $delete_modal = false;

    #[On('delete-modal')]
    public function confirmDelete(EmadEdeen $id)
    {
        $this->form->setSchema($id);
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete();
        $this->dispatch('delete-schema');
        $this->successNotify(__('Schema deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.emad-edeen.delete-schema');
    }
}
