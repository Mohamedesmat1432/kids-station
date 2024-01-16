<?php

namespace App\Traits;

use App\Models\Offer;

trait OfferTrait
{
    use WithNotify;
    public ?Offer $offer;
    public $offer_id;
    public $name;
    public $price;
    public $status;
    public $checkbox_arr = [];

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
        $data = Offer::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

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
}
