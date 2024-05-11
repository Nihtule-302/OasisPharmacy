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
                        <span id="buy-message" style="color: blue; display: block; margin: 0 auto; width: fit-content; font-weight: bold;">
                        </span>
                        <div style="max-height: 500px; overflow-y: auto;">
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

                            @if(!$items->isEmpty())
                            <div class="col-md-6 offset-md-3">
                                <form class="buyForm" action="{{ route('buy', $order->id) }}" method="GET">
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

@endsection
