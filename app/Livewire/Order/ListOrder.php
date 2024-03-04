<?php

namespace App\Livewire\Order;

use App\Traits\OrderTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListOrder extends Component
{
    use OrderTrait;

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('refresh-list-order')]
    public function render()
    {
        $this->authorize('view-order');

        return view('livewire.order.list-order', [
            'orders' => $this->orderList(),
        ])->layout('layouts.app');
    }
}
