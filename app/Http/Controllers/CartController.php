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
                ->select('pharmaceutical_products.*', 'orderd_items.*')
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

        // Check if order exists and its status is 'In Cart'
        if ($order && $order->status === 'In Cart') {
            // Finalize the order and set the order date
            $order->status = 'Finalized';
            $order->order_date = Carbon::now();
            $order->save();

            // Retrieve items in the order
            $items = OrderdItem::where('order_id', $order->id)->get();

            // Check if items exist
            if ($items->isNotEmpty()) {
                foreach ($items as $item) {
                    // Update product quantity
                    $product = PharmaceuticalProduct::find($item->product_id);
                    if ($product) {
                        $product->quantity -= $item->quantity;
                        $product->save();
                    }
                }
            }
        }

        return redirect(route('cart'));
    }

    public function removeFromCart($id)
    {
        $orderItem = OrderdItem::find($id);
        
        $order = Order::find($orderItem->order_id);
       
        if ($orderItem->quantity > 1) {
            $orderItem->decrement('quantity');
        } else {
            
            $orderItem->delete();
        }
   
        return redirect()->route('cart');
    }

}

