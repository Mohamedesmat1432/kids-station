<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\Unit;

trait ProductTrait
{
    use WithNotify;
    public ?Product $product;
    public $product_id;
    public $name;
    public $image;
    public $description;
    public $qty;
    public $purchase_price;
    public $price;
    public $revenue_price;
    public $unit_id;
    public $category_id;
    public $checkbox_arr = [];

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

    public function revenuePrice(){
        $this->revenue_price = floatval($this->price) - floatval($this->purchase_price);
    }

    public function quantity(){
        if($this->unit_id){
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
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    }

    public function checkboxAll()
    {
        $data = Product::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);

        if ($checkbox_count <= 1 || $checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteProduct()
    {
        $products = Product::whereIn('id', $this->checkbox_arr);
        $products->delete();
    }
}
