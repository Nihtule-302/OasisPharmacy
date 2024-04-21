@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 overflow-hidden">
    <div class="bg-image"">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-transparent border-0 shadow-lg">
                    <div class="card-header bg-transparent border-0 text-white">
                        <h2 class="mb-0">Product Listing</h2>
                    </div>

                    <div class="card-body bg-white-opacity">
                        <ul>
                            <?php
                            // Connect to the database
                            $servername = "127.0.0.1";
                            $username = "root";
                            $password = "";
                            $dbname = "oasis_pharmacy";

                            $conn = new mysqli($servername, $username, $password, $dbname);
                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            $sql = "SELECT * FROM pharmaceutical_products";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                
                                    echo "<li>{$row['product_name']} - Price: {$row['price']} - Expiry Date: {$row['expiration_date']} <a href='?Name={$row['product_name']}&Price={$row['price']}' class='add-to-cart-link'>Add to Cart</a></li>";
                                }
                            } else {
                                echo "No products available.";
                            }

                            //  adding products to cart
                            if(isset($_GET['Name']) && isset($_GET['Price'])) {
                                $productName = $_GET['Name'];
                                $productPrice = $_GET['Price'];

                                
                                session_start();

                                
                                if(!isset($_SESSION['cart'])) {
                                    $_SESSION['cart'] = array();
                                }

                            
                                $product = array('name' => $productName, 'price' => $productPrice);
                                array_push($_SESSION['cart'], $product);

                                
                                header("Location: veiwProduct.blade.php");
                                exit();
                            }

                            $conn->close();
                            ?>
                        </ul>
                        <a href="{{ route('cart') }}" class="view-cart-link">View Cart</a>
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection