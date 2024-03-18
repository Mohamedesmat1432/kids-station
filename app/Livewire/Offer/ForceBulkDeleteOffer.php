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
        $this->forceBulkDeleteOffer($this->checkbox_arr);
    }

    public function render()
    {
        return view('livewire.offer.force-bulk-delete-offer');
    }
}
