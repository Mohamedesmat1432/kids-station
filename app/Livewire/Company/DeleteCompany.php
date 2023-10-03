<?php

namespace App\Livewire\Company;

use App\Livewire\Forms\CompanyForm;
use App\Models\Company;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteCompany extends Component
{
    use WithNotify;

    public CompanyForm $form;

    public $delete_modal = false;

    #[On('delete-modal')]
    public function confirmDelete(Company $id)
    {
        $this->form->setCompany($id);
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete();
        $this->dispatch('delete-company');
        $this->successNotify(__('Company deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.company.delete-company');
    }
}
