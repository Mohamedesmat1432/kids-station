<?php

namespace App\Traits;

use App\Models\Offer;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait OfferTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait, WithFileUploads;

    public ?Offer $offer;
    public $offer_id;
    public $name;
    public $price;
    public $status;
    public $checkbox_arr = [];
    public $file;
    public $extension = 'xlsx';

    protected function rules()
    {
        return [
            'name' => 'required|string|min:4',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
        ];
    }

    public function setOffer($id)
    {
        $this->offer = Offer::findOrFail($id);
        $this->offer_id = $this->offer->id;
        $this->name = $this->offer->name;
        $this->price = $this->offer->price;
        $this->status =  $this->offer->status;
    }

    public function storeOffer()
    {
        $validated = $this->validate();
        Offer::create($validated);
        $this->reset();
    }

    public function updateOffer()
    {
        $validated = $this->validate();
        $this->offer->update($validated);
    }

    public function deleteOffer($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();
    }

    public function checkboxAll()
    {
        $offers_trashed = Offer::onlyTrashed()->pluck('id')->toArray();
        $offers = Offer::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trash ? $offers_trashed : $offers;

        if ($checkbox_count < 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteOffer()
    {
        $offers = Offer::whereIn('id', $this->checkbox_arr);
        $offers->delete();
    }

    public function offerList()
    {
        return cache()->remember('offers', 1, function () {
            $offers = $this->trash ? Offer::onlyTrashed() : Offer::withoutTrashed();
            
            return $offers->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('price', 'like', '%' . $this->search . '%');
                });
            })->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }

    public function restoreOffer($id)
    {
        $offer = Offer::onlyTrashed()->findOrFail($id);
        $offer->restore();
    }

    public function forceDeleteOffer($id)
    {
        $offer = Offer::onlyTrashed()->findOrFail($id);
        $offer->forceDelete();
    }

    public function forceBulkDeleteOffer()
    {
        $offers = Offer::onlyTrashed()->whereIn('id', $this->checkbox_arr);
        $offers->forceDelete();
    }
}
