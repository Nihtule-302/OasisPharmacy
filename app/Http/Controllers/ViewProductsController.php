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
        $product = PharmaceuticalProduct::find($id);

        $order = Order::where('user_id',Auth::user()->id)->first();

        if($order == null)
        {
            $order = new Order;
            $order->status = "In Cart";
            $order->total_price = 0;
            $order->save();
        }

        $item = new OrderdItem;

        $item->order_id = $order->id;
        $item->product_id = $product->id;
        $item->quantity = 1;

        $item->save();

        return redirect()->route('viewProduct');
    }
}
