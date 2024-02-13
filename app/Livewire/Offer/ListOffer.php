<?php

namespace App\Livewire\Offer;

use App\Models\Offer;
use App\Traits\OfferTrait;
use App\Traits\SortSearchTrait;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListOffer extends Component
{
    use OfferTrait;

    #[On('bulk-delete-clear')]
    #[On('force-bulk-delete-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('create-offer')]
    #[On('update-offer')]
    #[On('delete-offer')]
    #[On('import-offer')]
    #[On('export-offer')]
    #[On('bulk-delete-offer')]
    #[On('restore-offer')]
    #[On('force-delete-offer')]
    #[On('force-bulk-delete-offer')]
    public function render()
    {
        $this->authorize('view-offer');

        $offers = $this->offerList();

        return view('livewire.offer.list-offer', [
            'offers' => $offers,
        ]);
    }
}
