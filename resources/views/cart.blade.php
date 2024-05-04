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
                    <style>
                            table {
                                width: 100%;
                                border-collapse: collapse;
                                margin: 20px 0;
                            }
                            th, td {
                                text-align: left;
                                padding: 8px;
                                border-bottom: 1px solid #bbb;
                            }
                            th {
                                background-color: #e0e0e0;
                                color: #333;
                            }
                            tr:hover {
                                background-color: #d0d0d0;
                            }
                            .edit-delete-cell, .add-to-cart-cell {
                                visibility: hidden;
                            }
                            .auth-visible .edit-delete-cell, .auth-visible .add-to-cart-cell {
                                visibility: visible;
                            }
                        </style>
                    <table class="table">
                            <thead>
                              <tr>
                                <th>Product Name</th>
                                <th>Price</th>
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
                                    echo "<tr><td colspan='2'>Cart is empty.</td></tr>";
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
