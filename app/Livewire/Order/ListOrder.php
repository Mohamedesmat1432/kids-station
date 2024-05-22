<?php

namespace App\Livewire\Order;

use App\Models\Order;
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

    #[On('refresh-list-order-kids')]
    public function render()
    {
        $this->authorize('view-order-kids');

        $orders = $this->trash ? Order::onlyTrashed() : Order::withoutTrashed();
            
        $orders = $orders->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->search($this->search, $this->date)->paginate($this->page_element);

        return view('livewire.order.list-order', [
            'orders' => $orders,
        ]);
    }
}
