<?php

namespace App\Livewire\Orange;

use App\Livewire\Forms\OrangeForm;
use App\Models\Orange;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowOrange extends Component
{
    public OrangeForm $form;
    public $show_modal = false;

    #[On('show-modal')]
    public function show(Orange $id)
    {
        $this->form->setOrange($id);
        $this->show_modal = true;
    }

    public function render()
    {
        return view('livewire.orange.show-orange');
    }
}
