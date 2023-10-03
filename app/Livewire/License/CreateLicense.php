<?php

namespace App\Livewire\License;

use App\Livewire\Forms\LicenseForm;
use App\Models\Company;
use App\Traits\WithNotify;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateLicense extends Component
{
    use WithNotify, WithFileUploads;

    public LicenseForm $form;

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
        $this->dispatch('create-license');
        $this->successNotify(__('License created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        $companies = Company::pluck('name', 'id');

        return view('livewire.license.create-license', [
            'companies' => $companies
        ]);
    }
}
