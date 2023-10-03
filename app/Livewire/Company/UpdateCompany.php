<?php

namespace App\Livewire\Company;

use App\Livewire\Forms\CompanyForm;
use App\Models\Company;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateCompany extends Component
{
    use WithNotify;

    public CompanyForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(Company $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setCompany($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-company');
        $this->successNotify(__('Company updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.company.update-company');
    }
}
