<?php

namespace App\Livewire\Point;

use App\Livewire\Forms\PointForm;
use App\Traits\WithNotify;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeletePoint extends Component
{
    use WithNotify;

    public PointForm $form;

    public $delete_modal = false;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->form->delete($this->id);
        $this->dispatch('delete-point');
        $this->successNotify(__('Point deleted successfully'));
        $this->delete_modal = false;
    }

    public function render()
    {
        return view('livewire.point.delete-point');
    }
}
