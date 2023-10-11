<?php

namespace App\Livewire\License;

use App\Livewire\Forms\LicenseForm;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteLicense extends Component
{
    use WithNotify;

    public LicenseForm $form;

    public $delete_modal = false;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id,$name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete($this->id);
        $this->dispatch('delete-license');
        $this->successNotify(__('License deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.license.delete-license');
    }
}
