<?php

namespace App\Livewire\InvoiceDetails;

use App\Traits\InvoiceDetailsTrait;
use Livewire\Component;

class CreateInvoice extends Component
{
    use InvoiceDetailsTrait;

    public function createModal()
    {
        $this->reset();
        $this->resetValidation();
        $this->create_modal = true;
    }

    public function save()
    {
        $this->storeInvoiceDetail();
    }

    public function render()
    {
        return view('livewire.invoice-details.create-invoice');
    }
}
