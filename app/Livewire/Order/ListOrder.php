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
        $this->checkbox_status = false;
        $this->checkbox_arr = [];
    }

    #[On('refresh-list-order-kids')]
    public function render()
    {
        $this->authorize('view-order-kids');

        $orders = $this->trash ? Order::onlyTrashed() : Order::withoutTrashed();
            
        $orders =  $orders->search($this->search)->dateSearch($this->date)
            ->childSearch($this->child_search)
            ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        $this->checkbox_all = $orders->pluck('id')->toArray();

        return view('livewire.order.list-order', [
            'orders' => $orders,
        ]);
    }
}
