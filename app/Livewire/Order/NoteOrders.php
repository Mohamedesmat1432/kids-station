<?php

namespace App\Livewire\Order;

use App\Traits\OrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class NoteOrders extends Component
{
    use OrderTrait;

    public $count;

    #[On('note-modal')]
    public function confirmNoteOrders($arr)
    {
        $this->reset();
        $this->resetValidation();
        $this->checkbox_arr = json_decode($arr);
        $this->count = count($this->checkbox_arr);
        $this->note_modal = true;
    }

    public function updateNoteOrders()
    {
        $this->noteOrders($this->checkbox_arr);
    }

    public function render()
    {
        return view('livewire.order.note-orders');
    }
}
