<?php

namespace App\Livewire\Company;

use App\Livewire\Forms\CompanyForm;
use App\Traits\WithNotify;
use Livewire\Component;

class CreateCompany extends Component
{
    use WithNotify;

    public CompanyForm $form;

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
        $this->dispatch('create-company');
        $this->successNotify(__('Company created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        return view('livewire.company.create-company');
    }
}
