<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\Unit;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

trait ProductTrait
{
    use WithNotify;
    use ModalTrait;
    use SortSearchTrait;
    use WithPagination;
    use WithFileUploads;

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

    public function productList()
    {
        return cache()->remember('products', 1, function () {
            $products = $this->trashed ? Product::onlyTrashed() : new Product();

            return $products
                ->when($this->search, function ($query) {
                    return $query->where(function ($query) {
                        $query->where('name', 'like', '%' . $this->search . '%')->orWhere('price', 'like', '%' . $this->search . '%');
                    });
                })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }

    public function setProduct($id)
    {
        $this->product = Product::findOrFail($id);
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
        $validated = $this->validate();
        Product::create($validated);
        $this->reset();
    }

    public function updateProduct()
    {
        $validated = $this->validate();
        $this->product->update($validated);
        $this->reset();
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        $this->reset();
    }

    public function restoreProduct($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->restore();
    }

    public function forceDeleteProduct($id)
    {
        $product = Product::onlyTrashed()->findOrFail($id);
        $product->forceDelete();
    }

    public function checkboxAll()
    {
        $products_trashed = Product::onlyTrashed()->pluck('id')->toArray();
        $products = Product::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trashed ? $products_trashed : $products;

        if ($checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteProduct()
    {
        $products = Product::whereIn('id', $this->checkbox_arr);
        $products->delete();
        $this->reset();
    }

    public function forceBulkDeleteProduct()
    {
        $products = Product::onlyTrashed()->whereIn('id', $this->checkbox_arr);
        $products->forceDelete();
    }
}
