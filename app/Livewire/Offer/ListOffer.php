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
    use WithPagination, SortSearchTrait, OfferTrait;

    #[On('bulk-delete-clear')]
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
    public function render()
    {
        $this->authorize('view-offer');

        $offers = Offer::when($this->search, function ($query) {
            return $query->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')->orWhere('price', 'like', '%' . $this->search . '%');
            });
        })
            ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
            ->paginate($this->page_element);

        return view('livewire.offer.list-offer', [
            'offers' => $offers,
        ]);
    }
}
