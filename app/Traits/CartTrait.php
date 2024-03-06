<?php

namespace App\Traits;

use Illumniate\Support\Sleep;
use App\Models\Product;
use App\Models\ProductOrder;
use Cart;
use Livewire\WithPagination;


trait CartTrait
{
    use WithNotify;
    use WithPagination;
    use SortSearchTrait;
    public $cartItems = [];
    public $quantity = 1;

    public function cartData()
    {
        return Cart::getContent()->sortKeys()->toArray();
    }

    public function productList()
    {
        return cache()->remember('products', 1, function () {
            return Product::when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('price', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }

    public function addToCart(Product $product)
    {
        $cart_list = Cart::getContent()->pluck('id')->toArray();

        if (!in_array($product->id, $cart_list)) {
            if ($product->qty <= 1) {
                $this->successNotify(__('site.product_have_one'));
            } else {
                Cart::add([
                    'id' => $product->id,
                    'name' => $product->name,
                    'quantity' => $this->quantity,
                    'price' => $product->price,
                    'attributes' => [],
                ]);
                $this->dispatch('refresh-list-cart');
                $this->successNotify(__('site.add_to_cart_message'));
            }
        } else {
            $this->successNotify(__('site.product_found_in_cart'));
        }
    }

    public function removeCart($id)
    {
        Cart::remove($id);
        $this->dispatch('refresh-list-cart');
        $this->successNotify(__('site.remove_from_cart_message'));
    }

    public function clearAllCart()
    {
        Cart::clear();
        $this->dispatch('refresh-list-cart');
        $this->successNotify(__('site.remove_all_cart_message'));
    }

    public function createOrder()
    {
        ProductOrder::create([
            'number' => '#' . random_int(1000000, 9999999),
            'user_id' => auth()->user()->id,
            'products' => $this->cartItems,
            'total' => Cart::getTotal(),
        ]);

        foreach ($this->cartItems as $item) {
            $product = Product::findOrFail($item['id']);
            $product->update(['qty' => $product->qty - $item['quantity']]);
        }

        Cart::clear();
        $this->dispatch('refresh-list-cart');
        $this->dispatch('refresh-list-product-order');
        $this->successNotify(__('site.order_created'));
        $this->redirect('/product-orders', navigate: true);
    }
}
