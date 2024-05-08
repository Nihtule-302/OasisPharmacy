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
                                  @php $currentItem = null; @endphp
                                  @foreach($items as $item)
                                      @if($item->product_id == $product->id)
                                          @php $currentItem = $item; @endphp
                                      @endif
                                  @endforeach

                                  @if(Auth::check())
                                    <td>
                                      <form action="{{ route('add-to-cart', $product->id) }}">
                                          <input type="number" value="{{ $currentItem->quantity ?? 0 }}" name="quantity" min="1" max="{{ $product->quantity }}">
                                          <button type="submit" style="border: none; background: none; color: blue;">Add to Cart</button>
                                      </form>
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
