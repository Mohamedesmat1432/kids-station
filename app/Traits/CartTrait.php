<?php

namespace App\Traits;

use App\Models\Product;
use App\Models\ProductOrder;
use Cart;

trait CartTrait
{
    use  WithNotify;
    public $cartItems = [];
    public $quantity = 1;

    public function cartData()
    {
        return Cart::getContent()->sortKeys()->toArray();
    }

    public function addToCart(Product $product) {

        $cart_list = Cart::getContent()->pluck('id')->toArray();

       if(!in_array($product->id, $cart_list)) {
            if ($product->qty <= 1) {
                $this->successNotify(__('site.product_have_one'));
            } else {
                Cart::add([
                    'id'=> $product->id,
                    'name'=> $product->name,
                    'quantity' => $this->quantity,
                    'price'=> $product->price,
                    'attributes' => []
                ]);
                $this->dispatch('add-to-cart');
                $this->successNotify(__('site.add_to_cart_message'));
            }

       } else {
            $this->successNotify(__('site.product_found_in_cart'));
       }
    }

    public function removeCart($id)
    {
        Cart::remove($id);
        $this->dispatch('remove-from-cart');
        $this->successNotify(__('site.remove_from_cart_message'));
    }

    public function clearAllCart()
    {
        Cart::clear();
        $this->dispatch('remove-all-cart');
        $this->successNotify(__('site.remove_all_cart_message'));
    }

    public function createOrder()
    {
        ProductOrder::create([
            'number' => '#' . random_int(1000000, 9999999),
            'user_id' => auth()->user()->id,
            'products' => $this->cartItems,
            'total' => Cart::getTotal()
        ]);

        foreach($this->cartItems as $item) {
            $product = Product::findOrFail($item['id']);
            $product->update(['qty'=> $product->qty - $item['quantity']]);
        }

        $this->clearAllCart();
        $this->dispatch('create-product-order');
        $this->successNotify(__('site.order_created'));
    }

}