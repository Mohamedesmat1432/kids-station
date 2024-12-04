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

    public function showProductOrder($id)
    {
        $this->authorize('show-product-order');

        $this->product_order = ProductOrder::findOrFail($id);
    }

    public function setProductOrder($id)
    {
        $this->product_order = ProductOrder::withoutTrashed()->findOrFail($id);
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
        $this->authorize('delete-product-order');
        $product_order = ProductOrder::withoutTrashed()->findOrFail($id);
        $product_order->delete();
        $this->reset();
        $this->dispatch('refresh-list-product-order');
        $this->successNotify(__('site.product_order_deleted'));
        $this->delete_modal = false;
    }

    public function bulkDeleteProductOrder($arr)
    {
        $this->authorize('bulk-delete-product-order');
        $product_orders = ProductOrder::withoutTrashed()->whereIn('id', $arr);
        $product_orders->delete();
        $this->reset();
        $this->dispatch('refresh-list-product-order');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.product_order_delete_all'));
        $this->bulk_delete_modal = false;
    }

    public function restoreProductOrder($id)
    {
        $this->authorize('restore-product-order');
        $product_orders = ProductOrder::onlyTrashed()->findOrFail($id);
        $product_orders->restore();
        $this->reset();
        $this->dispatch('refresh-list-product-order');
        $this->successNotify(__('site.product_order_restored'));
        $this->restore_modal = false;
    }

    public function forceDeleteProductOrder($id)
    {
        $this->authorize('force-delete-product-order');
        $product_orders = ProductOrder::onlyTrashed()->findOrFail($id);
        $product_orders->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-product-order');
        $this->successNotify(__('site.product_order_deleted'));
        $this->force_delete_modal = false;
    }

    public function forceBulkDeleteProductOrder($arr)
    {
        $this->authorize('force-bulk-delete-product-order');
        $product_orders = ProductOrder::onlyTrashed()->whereIn('id', $arr);
        $product_orders->forceDelete();
        $this->reset();
        $this->dispatch('refresh-list-product-order');
        $this->dispatch('checkbox-clear');
        $this->successNotify(__('site.product_order_delete_all'));
        $this->force_bulk_delete_modal = false;
    }
}
