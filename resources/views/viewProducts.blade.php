@extends('layouts.app')

@section('content')
  <div class="container-fluid p-0 overflow-hidden">
      <div class="bg-image"">
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card bg-transparent border-0 shadow-lg">
                      <div class="card-header bg-transparent border-0 text-white">
                          <h2 class="mb-0"> Available Products</h2>
                      </div>

                      <div class="card-body bg-white-opacity"><style>
                            table {
                                width: 100%;
                                border-collapse: collapse;
                                margin: 20px 0;
                            }
                            th, td {
                                text-align: left;
                                padding: 8px;
                                border-bottom: 1px solid #bbb;
                            }
                            th {
                                background-color: #e0e0e0;
                                color: #333;
                            }
                            tr:hover {
                                background-color: #d0d0d0;
                            }
                            .edit-delete-cell, .add-to-cart-cell {
                                visibility: hidden;
                            }
                            .auth-visible .edit-delete-cell, .auth-visible .add-to-cart-cell {
                                visibility: visible;
                            }
                        </style>
                        <table>
                            <thead>
                              <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Expiration Date</th>
                                <th></th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach($products as $product)
                                <tr>
                                  <td>{{$product->product_name}}</td>
                                  <td>{{$product->price}}</td>
                                  <td>{{$product->description}}</td>
                                  <td>{{$product->expiration_date}}</td>

                                  @if(Auth::check())
                                    <td>
                                      <a href='#'>
                                        add to cart
                                      </a>&nbsp&nbsp&nbsp&nbsp
                                    </td>
                                  @endif
                                  
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                        
                        <a href="{{ route('cart') }}" class="view-cart-link">View Cart</a>
                      </div>


                  </div>
              </div>
          </div>
      </div>
   </div>
@endsection
