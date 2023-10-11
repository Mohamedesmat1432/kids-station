<?php

namespace App\Livewire\Orange;

use App\Livewire\Forms\OrangeForm;
use App\Models\Company;
use App\Models\Orange;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateOrange extends Component
{
    use WithNotify;

    public OrangeForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(Orange $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setOrange($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-orange');
        $this->successNotify(__('Orange updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        $companies = Company::pluck('name', 'id');

        return view('livewire.orange.update-orange',[
            'companies' => $companies
        ]);
    }
}
