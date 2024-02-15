<?php

namespace App\Livewire\Offer;

use App\Traits\OfferTrait;
use Livewire\Attributes\On;
use Livewire\Component;

class ForceBulkDeleteOffer extends Component
{
    use OfferTrait;

    public $count;

    #[On('force-bulk-delete-modal')]
    public function confirmDelete($arr)
    {
        $this->checkbox_arr = json_decode($arr);
        $this->count = count($this->checkbox_arr);
        $this->force_bulk_delete_modal = true;
    }

    public function delete()
    {
        $this->authorize('force-bulk-delete-offer');
        $this->forceBulkDeleteOffer();
        $this->dispatch('refresh-list-offer');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.offer_delete_all'));
        $this->force_bulk_delete_modal = false;
    }

    public function render()
    {
        return view('livewire.offer.force-bulk-delete-offer');
    }
}
