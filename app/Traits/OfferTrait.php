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
        $this->offer = Offer::withoutTrashed()->findOrFail($id);
        $this->offer_id = $this->offer->id;
        $this->name = $this->offer->name;
        $this->price = $this->offer->price;
        $this->status =  $this->offer->status;
    }

    public function storeOffer()
    {
        $this->authorize('create-offer');
        $validated = $this->validate();
        Offer::create($validated);
        $this->reset();
        $this->dispatch('refresh-list-offer');
        $this->successNotify(__('site.offer_created'));
        $this->create_modal = false;
    }

    public function updateOffer()
    {
        $this->authorize('edit-offer');
        $validated = $this->validate();
        $this->offer->update($validated);
        $this->reset();
        $this->dispatch('refresh-list-offer');
        $this->successNotify(__('site.offer_updated'));
        $this->edit_modal = false;
    }

    public function deleteOffer($id)
    {
        $this->authorize('delete-offer');
        $offer = Offer::withoutTrashed()->findOrFail($id);
        $offer->delete();
        $this->reset();
        $this->dispatch('refresh-list-offer');
        $this->successNotify(__('site.offer_deleted'));
        $this->delete_modal = false;
    }

    public function checkboxAll()
    {
        $offers_trashed = Offer::onlyTrashed()->pluck('id')->toArray();
        $offers = Offer::withoutTrashed()->pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trash ? $offers_trashed : $offers;

        if ($checkbox_count < 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteOffer($arr)
    {
        $this->authorize('bulk-delete-offer');
        $offers = Offer::withoutTrashed()->whereIn('id', $arr);
        $offers->delete();
        $this->reset();
        $this->dispatch('refresh-list-offer');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.offer_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function restoreOffer($id)
    {
        $this->authorize('restore-offer');
        $offer = Offer::onlyTrashed()->findOrFail($id);
        $offer->restore();
        $this->reset();
        $this->dispatch('refresh-list-offer');
        $this->successNotify(__('site.offer_restored'));
        $this->restore_modal = false;
    }

    public function forceDeleteOffer($id)
    {
        $this->authorize('force-delete-offer');
        $offer = Offer::onlyTrashed()->findOrFail($id);
        $offer->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-offer');
        $this->successNotify(__('site.offer_deleted'));
        $this->force_delete_modal = false;
    }

    public function forceBulkDeleteOffer($arr)
    {
        $this->authorize('force-bulk-delete-offer');
        $offers = Offer::onlyTrashed()->whereIn('id', $arr);
        $offers->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-offer');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.offer_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
}
