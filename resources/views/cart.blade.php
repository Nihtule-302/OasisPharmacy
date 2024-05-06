@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 overflow-hidden">
    <div class="bg-image"">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-transparent border-0 shadow-lg">
                    <div class="card-header bg-transparent border-0 text-white">
                        <h2 class="mb-0">Cart</h2>
                    </div>

                    <div class="card-body bg-white-opacity">
                        <table>
                            <thead>
                              <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th> 
                                <th></th> 
                              </tr>
                            </thead>
                            <tbody>
                                @foreach($items as $item)
                                <tr>
                                  <td>{{$item->product_name}}</td>
                                  <td>{{$item->price}}</td>
                                  <td>{{$item->quantity}}</td>
                                  

                                  @if(Auth::check())
                                    <td>
                                      <a href="{{ route('remove-from-cart', $item->id) }}">
                                         remove
                                      </a>&nbsp&nbsp&nbsp&nbsp
                                    </td>
                                  @endif
                    
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                        Total Price = {{$totalCost}}
                          
                        
                        <br>
                        <br>

                        @if($order)
                          <div class="col-md-6 offset-md-3">
                              <form action="{{ route('buy', $order->id) }}" method="GET">
                                  <button type="submit" class="btn btn-primary btn-block mb-4">
                                      Buy
                                  </button>
                              </form>
                          </div>
                        @endif

                        

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
