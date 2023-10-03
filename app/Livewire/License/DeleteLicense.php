<?php

namespace App\Livewire\License;

use App\Livewire\Forms\LicenseForm;
use App\Models\License;
use App\Traits\FileTrait;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteLicense extends Component
{
    use WithNotify;

    public LicenseForm $form;

    public $delete_modal = false;

    #[On('delete-modal')]
    public function confirmDelete(License $id)
    {
        $this->form->setLicense($id);
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete();
        $this->dispatch('delete-license');
        $this->successNotify(__('License deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.license.delete-license');
    }
}
