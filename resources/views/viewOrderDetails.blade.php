@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 overflow-hidden">
    <div class="bg-image"">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-transparent border-0 shadow-lg">
                    <div class="card-header bg-transparent border-0 text-white">
                        <h2 class="mb-0"> Order Details</h2>
                    </div>

                    <div class="card-body bg-white-opacity">
                        Order ID : {{$userAndOrderRecord->order_id}}<br>
                        Order Date : {{$userAndOrderRecord->order_date}}<br>
                        User Type: {{$userAndOrderRecord->role}}<br>
                        User Name: {{$userAndOrderRecord->name}}<br>
                        Telephone : {{$userAndOrderRecord->phone_number}}<br>

                        <table>
                            <thead>
                                <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Value</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($itemAndProductRecords as $item)
                                    <tr>
                                        <td>{{$item->product_name}}</td>
                                        <td>{{$item->price}}</td>
                                        <td>{{$item->orderd_quantity}}</td>
                                        <td>{{$item->price * $item->orderd_quantity}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        Item Count : {{
                                        $itemAndProductRecords->sum(function ($item) {
                                                return $item->orderd_quantity;
                                            })
                                    }}<br>
                        Total Price : {{$userAndOrderRecord->total_price}}<br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
