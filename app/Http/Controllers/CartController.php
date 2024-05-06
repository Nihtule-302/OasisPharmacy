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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
}

