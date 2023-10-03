<?php

namespace App\Livewire\License;

use App\Livewire\Forms\LicenseForm;
use App\Models\Company;
use App\Models\License;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateLicense extends Component
{
    use WithNotify, WithFileUploads;

    public LicenseForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(License $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setLicense($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-license');
        $this->successNotify(__('License updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        $companies = Company::pluck('name', 'id');

        return view('livewire.license.update-license', [
            'companies' => $companies
        ]);
    }
}
