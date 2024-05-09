<?php

namespace App\Http\Controllers;

use App\Models\PharmaceuticalProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class ModifyProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewModifyProduct()
    {
        if(Auth::user()->role == 'admin'){
            $products = PharmaceuticalProduct::all();
            return view('modifyProducts', compact('products'));
        }
        else{
          return redirect(route('home'));
        }
    }

    public function viewAddProduct()
    {
        if(Auth::user()->role == 'admin'){
            return view('addProducts');
        }
        else{
          return redirect(route('home'));
        }
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'expiration_date' => 'required|date',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'quantity' => 'required|numeric|min:0',
        ]);

        $product = new PharmaceuticalProduct;

        $product->product_name = $request->product_name;
        $product->expiration_date = $request->expiration_date;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;

        $product->save();

        return view('addProducts')->with('successMsg','Product Added successfully');
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
        $product = PharmaceuticalProduct::find($id);
        return view('editProducts',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //shady
    public function update(Request $request, $id)
    {
        $product = PharmaceuticalProduct::find($id);

        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->expiration_date = $request->expiration_date;
        $product->quantity = $request->quantity;

        $product->save();
        
        return redirect(route('modify-products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = PharmaceuticalProduct::find($id);
        $product->delete();
        return redirect(route('modify-products'))->with('successMsg','job Deleted successfully');
    }
}
