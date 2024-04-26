<?php

namespace App\Livewire\Order;

use App\Exports\OrdersExport;
use App\Traits\OrderTrait;
use Livewire\Component;

class ImportExportOrder extends Component
{
    use OrderTrait;

    public function exportModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->export_modal = true;
    }

    public function export()
    {
        try {
            $this->export_modal = false;
            $this->dispatch('refresh-list-order-kids');
            $this->successNotify(__('site.orders_exported'));
            return (new OrdersExport($this->search))->download('orders.' . $this->extension);
        } catch (\Throwable $e) {
            $this->errorNotify($e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.order.import-export-order');
    }
}
