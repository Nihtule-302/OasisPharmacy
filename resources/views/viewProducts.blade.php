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

                      <div class="card-body bg-white-opacity">
                        <table>
                            <thead>
                              <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Expiration Date</th>
                                <th>Quantity</th>
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
                                  <td>{{$product->quantity}}</td>

                                  @if(Auth::check())
                                    <td>
                                      <input id="quantity_{{$product->id}}" type="range" name="quantity" min="0" max="{{$product->quantity}}" value="0">
                                      <span id="quantityValue_{{$product->id}}">0</span>

                                      <script>
                                          document.getElementById('quantity_{{$product->id}}').addEventListener('input', function() {
                                              document.getElementById('quantityValue_{{$product->id}}').innerText = this.value;
                                          });
                                      </script>


                                        <form action="{{ route('add-to-cart', $product->id) }}" method="GET">
                                          <button type="submit">Add to Cart</button>
                                        </form>
                                        &nbsp&nbsp&nbsp&nbsp

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
