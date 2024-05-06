<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderdItem;
use App\Models\PharmaceuticalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class CartController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;

        $order = Order::where('user_id', $user_id)
                    ->where('status', 'In Cart')
                    ->first();

        if ($order && $order->status == 'In Cart') {
            $items = PharmaceuticalProduct::join('orderd_items', 'pharmaceutical_products.id', '=', 'orderd_items.product_id')
                ->select('pharmaceutical_products.*', 'orderd_items.quantity')
                ->where('orderd_items.order_id', $order->id)
                ->get();
            
            $totalCost = $items->sum(function ($item) {
                return $item->price * $item->quantity;
            });
        } else {
            $items = collect();
            $totalCost = 0;
        }

        return view('cart', compact('items', 'order', 'totalCost'));
    }

    public function buy()
    {
        $user_id = Auth::user()->id;
        $order = Order::where('user_id', $user_id)
                    ->where('status', 'In Cart')
                    ->first();

        if ($order) {
            $order->status = 'Finalized';
            $order->order_date = Carbon::now(); // Use Carbon for date handling
            $order->save();
        }

        return redirect(route('cart'));
    }
}

