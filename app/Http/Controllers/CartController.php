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
        if ($order) {
            // Retrieve items in the order
            $items = PharmaceuticalProduct::join('orderd_items', 'pharmaceutical_products.id', '=', 'orderd_items.product_id')
                ->select('pharmaceutical_products.*', 'orderd_items.*')
                ->where('orderd_items.order_id', $order->id)
                ->get();

            $totalPrice = 0;

            // Check if items exist
            if ($items->isNotEmpty()) {
                foreach ($items as $item) {
                    $totalPrice += $item->price * $item->quantity;

                    // Update product quantity
                    $product = PharmaceuticalProduct::find($item->product_id);
                    if ($product) {
                        $product->quantity -= $item->quantity;
                        $product->save();
                    }
                }

                $order->status = 'Finalized';
                $order->order_date = Carbon::now();
                $order->total_price = $totalPrice;
                $order->save();

                session()->flash('success', 'Order finalized successfully!');
            } else {
                session()->flash('error', 'No items found in the cart to finalize!');
            }
        } else {
            session()->flash('error', 'No active order found!');
        }

        //return redirect()->route('cart');
        return route('cart');
    }

    public function removeFromCart($id)
    {
        $orderItem = OrderdItem::find($id);

        if ($orderItem) {
            if ($orderItem->quantity > 1) {
                $orderItem->decrement('quantity');
            } else {
                $orderItem->delete();
            }

            session()->flash('success', 'Item removed from cart successfully!');
        } else {
            session()->flash('error', 'Item not found in the cart!');
        }

        return redirect()->route('cart');
    }
}
