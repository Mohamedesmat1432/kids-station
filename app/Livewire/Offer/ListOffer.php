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
        $this->checkbox_status = false;
    }

    #[On('refresh-list-offer')]
    public function render()
    {
        $this->authorize('view-offer');

        $offers = $this->trash ? Offer::onlyTrashed() : Offer::withoutTrashed();
            
        $offers = $offers->search($this->search)
            ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);
        
        $this->checkbox_all = $offers->pluck('id')->toArray();
            
        return view('livewire.offer.list-offer', [
            'offers' => $offers,
        ]);
    }
}
