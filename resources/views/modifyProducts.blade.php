@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 overflow-hidden">
    <div class="bg-image"">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-transparent border-0 shadow-lg">
                    <div class="card-header bg-transparent border-0 text-white">
                        <h2 class="mb-0">Management</h2>
                    </div>

                    <div class="card-body bg-white-opacity">
                        
                        <h3 class="card-title">Modify Product</h3>
                        <span id="edit-message" style="color: blue; display: block; margin: 0 auto; width: fit-content; font-weight: bold;">
                        </span>
                        <div style="max-height: 500px; overflow-y: auto;">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Description</th>
                                        <th>Expiration Date</th>
                                        <th>Quantity</th>                                    
                                        <th></th> <!-- Placeholder header for edit/delete -->
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->expiration_date}}</td>
                                        <td>{{$product->quantity}}</td>
                                        <td>
                                            <a href="{{route('edit-product', $product->id)}}">edit</a>
                                            &nbsp; &nbsp; &nbsp;
                                            <!--<a href="//{{route('delete-product', $product->id)}}" onclick="return confirm('Are you sure?')">delete</a>-->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

