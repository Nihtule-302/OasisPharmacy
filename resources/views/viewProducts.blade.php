@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Product Listing</h2>
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
@endsection