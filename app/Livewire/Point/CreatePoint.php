<?php

namespace App\Livewire\Point;

use App\Livewire\Forms\PointForm;
use App\Traits\WithNotify;
use Livewire\Component;

class CreatePoint extends Component
{
    use WithNotify;

    public PointForm $form;

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
        $this->dispatch('create-point');
        $this->successNotify(__('Point created successfully'));
        $this->create_modal = false;
    }

    public function render()
    {
        return view('livewire.point.create-point');
    }
}
