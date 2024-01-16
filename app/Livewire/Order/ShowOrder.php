<?php

namespace App\Livewire\Order;

use App\Traits\OrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowOrder extends Component
{
    use OrderTrait;
    public $show_modal = false;

    #[On('show-modal')]
    public function showModal($id)
    {
        $this->authorize('show-order');
        $this->setOrder($id);
        $this->show_modal = true;
    }

    public function render()
    {
        return view('livewire.order.show-order');
    }
}
