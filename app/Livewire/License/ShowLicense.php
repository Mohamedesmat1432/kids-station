<?php

namespace App\Livewire\License;

use App\Livewire\Forms\LicenseForm;
use App\Models\License;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowLicense extends Component
{
    public LicenseForm $form;
    public $show_modal = false;

    #[On('show-modal')]
    public function show(License $id)
    {
        $this->form->setLicense($id);
        $this->show_modal = true;
    }

    public function render()
    {
        return view('livewire.license.show-license');
    }
}
