<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderdItem;
use App\Models\PharmaceuticalProduct;
use App\Models\User;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('status', 'Finalized')->get();

        if ($orders->isNotEmpty()) {
            $joinOrders = User::join('orders', 'users.id', '=', 'orders.user_id')
                ->where('orders.status', 'Finalized')
                ->select('users.*', 'orders.id as order_id' ,'orders.*')
                ->get();

        } else {
            $joinOrders = collect();
        }
        return view('viewOrders', compact('orders', 'joinOrders'));

    }
    public function viewOrderDetails($orderId)
    {

       $userAndOrderRecord = User::join('orders', 'users.id', '=', 'orders.user_id')
        ->where('orders.id', $orderId)
        ->select('users.id as user_id', 'users.name', 'users.*', 'orders.id as order_id' , 'orders.*') // Specify explicit column names
        ->first();


        $itemAndProductRecords = OrderdItem::join('pharmaceutical_products', 'pharmaceutical_products.id', '=', 'orderd_items.product_id')
        ->where('orderd_items.order_id', $orderId)
        ->select('orderd_items.quantity as orderd_quantity','orderd_items.*', 'pharmaceutical_products.*')
        ->get();

        $items = OrderdItem::where('order_id', $orderId)->get();

        return view('viewOrderDetails', compact('userAndOrderRecord', 'itemAndProductRecords'));
    }

}
