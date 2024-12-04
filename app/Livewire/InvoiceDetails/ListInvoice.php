<?php

namespace App\Livewire\InvoiceDetails;

use App\Models\InvoiceDetail;
use App\Traits\InvoiceDetailsTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ListInvoice extends Component
{
    use InvoiceDetailsTrait;

    #[On('refresh-list-invoice-details')]
    public function render()
    {
        $this->authorize('view-invoice-details');

        $invoice_details = InvoiceDetail::search($this->search)
            ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        return view('livewire.invoice-details.list-invoice', [
            'invoice_details' => $invoice_details
        ]);
    }
}
