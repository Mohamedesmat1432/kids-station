<?php

namespace App\Livewire\InvoiceDetails;

use App\Traits\InvoiceDetailsTrait;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteInvoice extends Component
{
    use InvoiceDetailsTrait;

    #[Locked]
    public $id, $name;

    #[On('delete-modal')]
    public function confirmDelete($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->delete_modal = true;
    }

    public function delete()
    {
        $this->deleteInvoiceDetail($this->id);
    }

    public function render()
    {
        return view('livewire.invoice-details.delete-invoice');
    }
}
