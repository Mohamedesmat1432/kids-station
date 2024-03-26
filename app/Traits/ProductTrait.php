<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\Unit;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait ProductTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait, WithFileUploads;

    public ?Product $product;
    public $product_id;
    public $name;
    public $image;
    public $description;
    public $qty = 1;
    public $purchase_price;
    public $price;
    public $revenue_price;
    public $unit_id;
    public $category_id;
    public $checkbox_arr = [];
    public $file;
    public $extension = 'xlsx';

    protected function rules()
    {
        return [
            'name' => 'required|string|min:2|unique:products,name,' . $this->product_id,
            'description' => 'nullable|string',
            'qty' => 'required|numeric',
            'price' => 'required|numeric',
            'purchase_price' => 'required|numeric',
            'revenue_price' => 'required|numeric',
            'unit_id' => 'required|exists:units,id',
            'category_id' => 'required|exists:categories,id',
        ];
    }

    public function setProduct($id)
    {
        $this->product = Product::withoutTrashed()->findOrFail($id);
        $this->product_id = $this->product->id;
        $this->name = $this->product->name;
        $this->description = $this->product->description;
        $this->qty = $this->product->qty;
        $this->price = $this->product->price;
        $this->purchase_price = $this->product->purchase_price;
        $this->revenue_price = $this->product->revenue_price;
        $this->unit_id = $this->product->unit_id;
        $this->category_id = $this->product->category_id;
    }

    public function revenuePrice()
    {
        $this->revenue_price = floatval($this->price) - floatval($this->purchase_price);
    }

    public function changeQuantity()
    {
        if ($this->unit_id) {
            $this->qty *= Unit::findOrFail($this->unit_id)->qty;
        }
    }

    public function storeProduct()
    {
        $this->authorize('create-product');
        $validated = $this->validate();
        Product::create($validated);
        $this->reset();
        $this->dispatch('refresh-list-product');
        $this->successNotify(__('site.product_created'));
        $this->create_modal = false;
    }

    public function updateProduct()
    {
        $this->authorize('edit-product');
        $validated = $this->validate();
        $this->product->update($validated);
        $this->dispatch('refresh-list-product');
        $this->successNotify(__('site.product_updated'));
        $this->edit_modal = false;
    }

    public function deleteProduct($id)
    {
        $this->authorize('delete-product');
        $product = Product::withoutTrashed()->findOrFail($id);
        $product->delete();
        $this->reset();
        $this->dispatch('refresh-list-product');
        $this->successNotify(__('site.product_deleted'));
        $this->delete_modal = false;
    }

    public function restoreProduct($id)
    {
        $this->authorize('restore-product');
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
        $this->dispatch('refresh-list-product');
        $this->successNotify(__('site.product_restored'));
        $this->restore_modal = false;
    }

    public function forceDeleteProduct($id)
    {
        $this->authorize('force-delete-product');
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
        $this->dispatch('refresh-list-product');
        $this->successNotify(__('site.product_deleted'));
        $this->reset();
        $this->force_delete_modal = false;
    }

    public function checkboxAll()
    {
        $products_trashed = Product::onlyTrashed()->pluck('id')->toArray();
        $products = Product::withoutTrashed()->pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trash ? $products_trashed : $products;

        if ($checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteProduct($arr)
    {
        $this->authorize('bulk-delete-product');
        $products = Product::withoutTrashed()->whereIn('id', $arr);
        $products->delete();
        $this->reset();
        $this->dispatch('refresh-list-product');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.product_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function forceBulkDeleteProduct($arr)
    {
        $this->authorize('force-bulk-delete-product');
        $products = Product::onlyTrashed()->whereIn('id', $arr);
        $products->forceDelete();
        $this->dispatch('refresh-list-product');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.product_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
}
