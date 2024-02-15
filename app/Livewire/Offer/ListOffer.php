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

    #[On('checkbox-clear')]
    public function checkboxClear()
    {
        $this->checkbox_arr = [];
    }

    #[On('refresh-list-offer')]
    public function render()
    {
        $this->authorize('view-offer');

        $offers = $this->offerList();

        return view('livewire.offer.list-offer', [
            'offers' => $offers,
        ]);
    }
}
