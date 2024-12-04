<?php

namespace App\Livewire\InvoiceDetails;

use App\Traits\InvoiceDetailsTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class UpdateInvoice extends Component
{
    use InvoiceDetailsTrait;

    #[On('edit-modal')]
    public function confirmEdit($id)
    {
        $this->reset();
        $this->resetValidation();
        $this->setInvoiceDetail($id);
        $this->edit_modal = true;
    }

    public function save()
    {
        $this->updateInvoiceDetail();
    }

    public function render()
    {
        return view('livewire.invoice-details.update-invoice');
    }
}
