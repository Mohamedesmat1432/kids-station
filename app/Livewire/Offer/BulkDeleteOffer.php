<?php

namespace App\Livewire\Offer;

use App\Traits\OfferTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class BulkDeleteOffer extends Component
{
    use OfferTrait;
    public $bulk_delete_modal = false;
    public $count;

    #[On('bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->checkbox_arr = json_decode($arr);
        $this->count = count($this->checkbox_arr);
        $this->bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('bulk-delete-offer');
        $this->bulkDeleteOffer();
        $this->dispatch('bulk-delete-offer');
        $this->dispatch('bulk-delete-clear');
        $this->successNotify(__('site.offer_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.offer.bulk-delete-offer');
    }
}
