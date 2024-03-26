<?php

namespace App\Livewire\Offer;

use App\Models\Offer;
use App\Traits\OfferTrait;
use Livewire\Attributes\On;
use Livewire\Component;

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

        $offers = $this->trash ? Offer::onlyTrashed() : Offer::withoutTrashed();
            
        $offers = $offers->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->search($this->search)->paginate($this->page_element);
            
        return view('livewire.offer.list-offer', [
            'offers' => $offers,
        ]);
    }
}
