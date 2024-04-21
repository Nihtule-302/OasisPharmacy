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
                        <ul>
                            <?php
                            session_start();
                            // Check if cart is empty
                            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                $totalPrice = 0;
                                foreach($_SESSION['cart'] as $item) {
                                    echo "<li>{$item['name']} - Price: {$item['price']}</li>";
                                    $totalPrice += $item['price'];
                                }
                                echo "<li>Total Price: $totalPrice</li>";
                            } else {
                                echo "<li>Cart is empty.</li>";
                            }
                            ?>
                        </ul>
                        <a href="{{route('view-products')}}" class="continue-shopping-link">Continue Shopping</a>    
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
