<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PharmaceuticalProduct;
use App\Models\Order;
use App\Models\OrderdItem;
use Illuminate\Support\Facades\Auth;

class ViewProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = PharmaceuticalProduct::all();
        return view('viewProducts', compact('products'));
    }

    public function addToCart(Request $request, $id)
    {
        // Find the product by its ID
        $product = PharmaceuticalProduct::find($id);

        // Check if there's an existing order for the current user
        $order = Order::where('user_id', Auth::user()->id)->first();

        // If no order exists, create a new one
        if ($order === null) {
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->status = "In Cart";
            $order->total_price = 0;
            $order->save();
        }

        // Check if the product is already in the cart
        $item = OrderdItem::where('order_id', $order->id)
                        ->where("product_id", $product->id)
                        ->first();

        // If the product is not in the cart, add it as a new item
        if ($item === null) {
            $item = new OrderdItem;
            $item->order_id = $order->id;
            $item->product_id = $product->id;
            $item->quantity = 1;
            $item->save();
        } else {
            // If the product is already in the cart, increase its quantity
            $item->quantity += 1;
            $item->save();
        }

        return redirect()->route('view-products');
    }

}
