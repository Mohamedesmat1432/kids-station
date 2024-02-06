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
    use WithPagination, SortSearchTrait, OrderTrait;

    #[On('bulk-delete-clear')]
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
    public function render()
    {
        $this->authorize('view-order');

        $orders = cache()->remember('orders', 1, function () {
            return  Order::when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('number', 'like', '%' . $this->search . '%')
                        ->orWhere('customer_name', 'like', '%' . $this->search . '%')
                        ->orWhere('customer_phone', 'like', '%' . $this->search . '%')
                        ->orWhere('visitors', 'like', '%' . $this->search . '%');
                });
            })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
        // $orders = Order::when($this->search, function ($query) {
        //     return $query->where(function ($query) {
        //         $query->where('number', 'like', '%' . $this->search . '%')
        //             ->orWhere('customer_name', 'like', '%' . $this->search . '%')
        //             ->orWhere('customer_phone', 'like', '%' . $this->search . '%')
        //             ->orWhere('visitors', 'like', '%' . $this->search . '%');
        //     });
        // })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
        //     ->paginate($this->page_element);

        return view('livewire.order.list-order', [
            'orders' => $orders
        ]);
    }
}
