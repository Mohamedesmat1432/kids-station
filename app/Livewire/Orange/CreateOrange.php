<?php

namespace App\Livewire\Orange;

use App\Livewire\Forms\OrangeForm;
use App\Models\Company;
use App\Traits\WithNotify;
use Livewire\Component;

class CreateOrange extends Component
{
    use WithNotify;

    public OrangeForm $form;

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
        $this->dispatch('create-orange');
        $this->successNotify(__('Orange created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        $companies = Company::pluck('name', 'id');

        return view('livewire.orange.create-orange', [
            'companies' => $companies
        ]);
    }
}
