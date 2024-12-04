<?php

namespace App\Traits;

use App\Models\InvoiceDetail;
use Livewire\WithPagination;

trait InvoiceDetailsTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait;

    public ?InvoiceDetail $invoice_detail;
    public $invoice_detail_id;
    public $note;
    public $status;
    public $image;

    protected function rules()
    {
        return [
            'note' => 'required|string|min:2|unique:invoice_details,note,' . $this->invoice_detail_id,
            'status' => 'required|boolean',
        ];
    }

    public function setInvoiceDetail($id)
    {
        $this->invoice_detail = InvoiceDetail::findOrFail($id);
        $this->invoice_detail_id = $this->invoice_detail->id;
        $this->note = $this->invoice_detail->note;
        $this->status = $this->invoice_detail->status;
    }

    public function storeInvoiceDetail()
    {
        $this->authorize('create-invoice-details');
        $validated = $this->validate();
        InvoiceDetail::create($validated);
        $this->reset();
        $this->dispatch('refresh-list-invoice-details');
        $this->successNotify(__('site.invoice_details_created'));
        $this->create_modal = false;
    }

    public function updateInvoiceDetail()
    {
        $this->authorize('edit-invoice-details');
        $validated = $this->validate();
        $this->invoice_detail->update($validated);
        $this->reset();
        $this->dispatch('refresh-list-invoice-details');
        $this->successNotify(__('site.invoice_details_updated'));
        $this->edit_modal = false;
    }

    public function deleteInvoiceDetail($id)
    {
        $this->authorize('delete-invoice-details');
        $invoice_detail = InvoiceDetail::findOrFail($id);
        $invoice_detail->delete();
        $this->reset();
        $this->dispatch('refresh-list-invoice-details');
        $this->successNotify(__('site.invoice_details_deleted'));
        $this->delete_modal = false;
    }

    public function bulkDeleteInvoiceDetail($arr)
    {
        $invoice_details = InvoiceDetail::whereIn('id', $arr);
        $invoice_details->delete();
        $this->reset();
    }
}
