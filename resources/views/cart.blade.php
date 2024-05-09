@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 overflow-hidden">
    <div class="bg-image">
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

                                  <td>
                                    <a href="{{ route('remove-from-cart', $item->id) }}">
                                        remove
                                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                  </td>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                        Total Price = {{$totalCost}}

                        <br>
                        <br>

                        @if (session('success'))
                          <div id="flash-message" class="modal-message">
                              <p>{{ session('success') }}</p>
                          </div>
                        @endif
                        @if (session('error'))
                          <div id="flash-message" class="modal-message">
                              <p>{{ session('error') }}</p>
                          </div>
                        @endif

                        <br>
                        <br>

                        @if(!$items->isEmpty())
                          <div class="col-md-6 offset-md-3">
                              <form id="buyForm" action="{{ route('buy', $order->id) }}" method="GET">
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

<!-- Add some styles for the modal -->
<style>
    .modal-message {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: white;
        border: 1px solid #ddd;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        z-index: 1000;
        display: none;
    }
</style>

<!-- Add the JavaScript to hide the modal after a few seconds -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var flashMessage = document.querySelectorAll('#flash-message');
        flashMessage.forEach(function(message) {
            if (message.querySelector('p')) {
                message.style.display = 'block';
                setTimeout(function() {
                    message.style.display = 'none';
                }, 3000); // 3 seconds
            }
        });
    });
</script>
@endsection
