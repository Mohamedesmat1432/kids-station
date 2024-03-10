<?php

namespace App\Traits;
use App\Models\ProductOrder;
use Livewire\WithPagination;

trait ProductOrderTrait
{
    use WithNotify, SortSearchTrait, WithPagination, ModalTrait;

    public ?ProductOrder $product_order;
    public $product_order_id;
    public $number;
    public $casher_name;
    public $products;
    public $total;
    public $status;
    public $created_at;
    public $checkbox_arr = [];

    public function setProductOrder($id)
    {
        $this->product_order = ProductOrder::findOrFail($id);
        $this->product_order_id = $this->product_order->id;
        $this->number = $this->product_order->number;
        $this->casher_name = $this->product_order->user->name;
        $this->products = $this->product_order->products;
        $this->total = $this->product_order->total;
        $this->status = $this->product_order->status;
        $this->created_at = $this->product_order->created_at;
    }

    public function deleteProductOrder($id)
    {
        $product_order = ProductOrder::findOrFail($id);
        $product_order->delete();
    }

    public function checkboxAll()
    {
        $product_orders_trashed = ProductOrder::onlyTrashed()->pluck('id')->toArray();
        $product_orders = ProductOrder::pluck('id')->toArray();
        $checkbox_count = count($this->checkbox_arr);
        $data = $this->trash ? $product_orders_trashed : $product_orders;

        if ($checkbox_count < count($data)) {
            $this->checkbox_arr = $data;
        } else {
            $this->checkbox_arr = [];
        }
    }

    public function bulkDeleteProductOrder()
    {
        $product_orders = ProductOrder::whereIn('id', $this->checkbox_arr);
        $product_orders->delete();
    }

    public function productOrderList()
    {
        return cache()->remember('product_orders', 1, function () {
            if (auth()->user()->hasRole(['Super Admin', 'Admin'])) {
                $product_orders = $this->trash 
                    ? ProductOrder::onlyTrashed() 
                    : ProductOrder::withoutTrashed();
            } else {
                $product_orders = $this->trash 
                    ? auth()->user()->productOrders()->onlyTrashed() 
                    : auth()->user()->productOrders()->withoutTrashed();
            }
            
            return $product_orders->when($this->search, function ($query) {
                return $query->where(function ($query) {
                    $query->where('total', 'like', '%' . $this->search . '%')
                        ->orWhere('products', 'like', '%' . $this->search . '%');
                });
            })
                ->orderBy($this->sort_by, $this->sort_asc ? 'ASC' : 'DESC')
                ->paginate($this->page_element);
        });
    }

    public function restoreProductOrder($id)
    {
        $product_orders = ProductOrder::onlyTrashed()->findOrFail($id);
        $product_orders->restore();
    }

    public function forceDeleteProductOrder($id)
    {
        $product_orders = ProductOrder::onlyTrashed()->findOrFail($id);
        $product_orders->forceDelete();
    }

    public function forceBulkDeleteProductOrder()
    {
        $product_orders = ProductOrder::onlyTrashed()->whereIn('id', $this->checkbox_arr);
        $product_orders->forceDelete();
    }
}
