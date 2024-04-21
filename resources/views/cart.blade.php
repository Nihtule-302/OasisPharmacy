@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 overflow-hidden">
    <div class="bg-image"">
        <h2>Cart</h2>
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
@endsection
