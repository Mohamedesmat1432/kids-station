<?php

namespace App\Livewire\Point;

use App\Livewire\Forms\PointForm;
use App\Models\Point;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdatePoint extends Component
{
    use WithNotify;

    public PointForm $form;

    public $edit_modal = false;

    #[On('edit-modal')]
    public function confirmEdit(Point $id)
    {
        $this->form->reset();
        $this->resetValidation();
        $this->form->setPoint($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->form->update();
        $this->dispatch('update-point');
        $this->successNotify(__('Point updated successfully'));
        $this->edit_modal = false;
    }

    public function render()
    {
        return view('livewire.point.update-point');
    }
}
