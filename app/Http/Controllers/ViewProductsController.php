<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PharmaceuticalProduct;
use App\Models\Order;
use App\Models\OrderdItem;
use Illuminate\Support\Facades\Auth;

class ViewProductsController extends Controller
{
    public function index()
    {
        $products = PharmaceuticalProduct::all();

        $user_id = Auth::user()->id;

        $order = Order::where('user_id', $user_id)
                    ->where('status', 'In Cart')
                    ->first();
        
        if($order){
        $items = OrderdItem::where('order_id', $order->id)
                    ->get();
        } else {
            $items = collect();
        }

        return view('viewProducts', compact('products',"items"));
    }

    public function addToCart(Request $request, $id)
    {
        $product = PharmaceuticalProduct::find($id);

        // Find the order for the current user with "In Cart" status
        $order = Order::where('user_id', Auth::user()->id)
                    ->where('status', 'In Cart')
                    ->first();

        // If no order exists, create a new one
        if (!$order) {
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->status = "In Cart";
            $order->total_price = 0;
            $order->save();
        }

        // Check if the product is already in the cart
        $item = OrderdItem::where('order_id', $order->id)
                        ->where('product_id', $product->id)
                        ->first();

        // If the product is not in the cart, add it as a new item
        if (!$item) {
            $item = new OrderdItem;
            $item->order_id = $order->id;
            $item->product_id = $product->id;
            $item->quantity = $request->quantity;
            $item->save();
        } else {
            // If the product is already in the cart, increase its quantity
            $item->quantity = $request->quantity;
            $item->save();
        }

        // Redirect the user to the view products page
        return redirect()->route('view-products');
    }
}

