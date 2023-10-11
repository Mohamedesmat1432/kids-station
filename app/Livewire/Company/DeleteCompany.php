<?php

namespace App\Livewire\Company;

use App\Livewire\Forms\CompanyForm;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteCompany extends Component
{
    use WithNotify;

    public CompanyForm $form;

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
        $this->dispatch('delete-company');
        $this->successNotify(__('Company deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.company.delete-company');
    }
}
