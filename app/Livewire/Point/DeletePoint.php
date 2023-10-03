<?php

namespace App\Livewire\Point;

use App\Livewire\Forms\PointForm;
use App\Models\Point;
use App\Traits\WithNotify;
use Livewire\Attributes\On;
use Livewire\Component;

class DeletePoint extends Component
{
    use WithNotify;

    public PointForm $form;

    public $delete_modal = false;

    #[On('delete-modal')]
    public function confirmDelete(Point $id)
    {
        $this->form->setPoint($id);
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete();
        $this->dispatch('delete-point');
        $this->successNotify(__('Point deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.point.delete-point');
    }
}
