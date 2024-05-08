@extends('layouts.app')

@section('content')
  <div class="container-fluid p-0 overflow-hidden">
      <div class="bg-image"">
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card bg-transparent border-0 shadow-lg">
                      <div class="card-header bg-transparent border-0 text-white">
                          <h2 class="mb-0"> Orders</h2>
                      </div>

                      <div class="card-body bg-white-opacity">
                        <table>
                            <thead>
                              <tr>
                                <th>Order ID</th>
                                <th>User Type</th>
                                <th>User Name</th>
                                <th>Total Price</th>
                                <th>Order Date</th>
                                <th></th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach($joinOrders as $item)
                                <tr>
                                  <td>{{ $item->order_id}}</td>
                                  <td>{{ $item->role }}</td>
                                  <td>{{ $item->name }}</td>
                                  <td>{{ $item->total_price }}</td>
                                  <td>{{ $item->order_date }}</td>
                                  <td>
                                    <form action="{{ route('view-order-details', $item->order_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="border: none; background: none; color: blue;">View Order Details</button>
                                    </form>
                                  </td>
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
