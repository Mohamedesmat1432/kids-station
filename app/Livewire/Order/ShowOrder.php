<?php

namespace App\Livewire\Order;

use App\Traits\OrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ShowOrder extends Component
{
    use OrderTrait;

    #[On('show-modal')]
    public function showModal($id)
    {
        $this->authorize('show-order-kids');
        $this->showOrder($id);
        $this->show_modal = true;
    }

    public function render()
    {
        return view('livewire.order.show-order');
    }
}
