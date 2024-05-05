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
                              </tr>
                            </thead>
                            <tbody>
                                <?php
                                session_start();
                                // Check if cart is empty
                                if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                    $totalPrice = 0;
                                    foreach($_SESSION['cart'] as $item) {
                                        echo "<tr><td>{$item['name']}</td><td>\${$item['price']}</td></tr>";
                                        $totalPrice += $item['price'];
                                    }
                                    echo "<tr><td><strong>Total Price</strong></td><td><strong>\$$totalPrice</strong></td></tr>";
                                } else {
                                    echo "<tr><td colspan='3'>Cart is empty.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <a href="{{route('view-products')}}" class="continue-shopping-link">Continue Shopping</a>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
