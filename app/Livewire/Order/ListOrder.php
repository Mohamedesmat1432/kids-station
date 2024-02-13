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

    #[On('bulk-delete-clear')]
    #[On('force-bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-order')]
    #[On('attach-order')]
    #[On('delete-order')]
    #[On('import-order')]
    #[On('export-order')]
    #[On('bulk-delete-order')]
    #[On('restore-order')]
    #[On('force-delete-order')]
    #[On('force-bulk-delete-order')]
    public function render()
    {
        $this->authorize('view-order');

        $orders = $this->orderList();

        return view('livewire.order.list-order', [
            'orders' => $orders
        ]);
    }
}
