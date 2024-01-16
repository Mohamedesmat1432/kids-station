<?php

namespace App\Traits;
use App\Models\ProductOrder;

trait ProductOrderTrait
{
    public ?ProductOrder $product_order;
    public $product_order_id;
    public $number;
    public $casher_name;
    public $products;
    public $total;
    public $created_at;



    public function setProductOrder($id)
    {
        $this->product_order = ProductOrder::findOrFail($id);
        $this->product_order_id = $this->product_order->id;
        $this->number = $this->product_order->number;
        $this->casher_name = $this->product_order->user->name;
        $this->products = $this->product_order->products;
        $this->total = $this->product_order->total;
        $this->created_at = $this->product_order->created_at;
    }
}