<?php

namespace App\Livewire\Order;

use App\Models\Order;
use App\Traits\OrderTrait;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

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

        $orders = $this->orderList();

        return view('livewire.order.list-order', [
            'orders' => $orders
        ]);
    }
}
