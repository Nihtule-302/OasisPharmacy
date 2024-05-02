<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PharmaceuticalProduct;

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

    public function addToCart(Request $request)
    {
        $productName = $request->input('Name');
        $productPrice = $request->input('Price');

        
        $cart = $request->session()->get('cart', []);

        
        $product = ['name' => $productName, 'price' => $productPrice];
        $cart[] = $product;

        $request->session()->put('cart', $cart);

        return redirect()->route('viewProduct');
    }
}
