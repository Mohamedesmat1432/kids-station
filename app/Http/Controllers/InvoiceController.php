<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function kidsInvoice($id)
    {
        $order = Order::findOrFail($id);

        return view('pages.invoice-kids', [
            'order' => $order,
        ]);
    }

    public function productInvoice($id)
    {
        $product_order = ProductOrder::findOrFail($id);
        return view('pages.invoice-product', ['product_order' => $product_order]);
    }
}
