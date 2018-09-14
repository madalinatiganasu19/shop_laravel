<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrdersController extends Controller
{
    public function orders(Request $request) {
        $orders = new Order();

        $orders = DB::table($orders->getTable())
                            ->join('order_product', $orders->getQualifiedKeyName(), '=', 'order_product.order_id')
                            ->join('products', 'products.id', '=', 'order_product.product_id')
                            ->select('orders.*', DB::raw('SUM(products.price) as total'))
                            ->groupBy('orders.id')
                            ->get();

        if ($request->ajax()) {
            return $orders;
        }

        return view('orders.orders')->with([
            'orders'=> $orders,
        ]);
    }

    public function order(Request $request) {

        $order = Order::query()->find($request->get('id'));
        $products = $order->products;

        if ($request->ajax()) {
            return $products;
        }

        return view('orders.order')->with('products', $products);
    }
}
