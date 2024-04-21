@extends('layouts.app')

@section('content')
<div class="container-fluid p-0 overflow-hidden">
    <div class="bg-image"">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-transparent border-0 shadow-lg">
                    <div class="card-header bg-transparent border-0 text-white">
                        <h2 class="mb-0">Management</h2>
                    </div>

                    <div class="card-body bg-white-opacity">
                        <h3 class="card-title">Add Product</h3>

                        <form action="{{ route('modify-products') }}" method="post">

                            <div class="row mb-3">
                                <label for="product_name" class="col-md-4 col-form-label text-md-end">{{ __('Product Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="product_name" type="text" class="form-control" name="product_name">
                                </div>
                                
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
    
                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control" name="price">
                                </div>
                                
                            </div>

                            <div class="row mb-3">
                                <label for="expiry_date" class="col-md-4 col-form-label text-md-end">{{ __('Expiry Date') }}</label>
    
                                <div class="col-md-6">
                                    <input id="expiry_date" type="date" class="form-control" name="expiry_date">
                                </div>
                                
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Add Product') }}
                                    </button>
                                </div>
                            </div>
                            
                        </form>

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

                        
                            if(isset($_POST['add_product'])) {
                                $productName = $_POST['product_name'];
                                $productId =$_POST['product_id'];
                                $price = $_POST['price'];
                                $expiryDate = $_POST['expiry_date'];

                                
                                $sql = "INSERT INTO pharmaceutical_products (product_name,product_id ,price, expiration_date) VALUES ('$productName', '$productId', '$price', '$expiryDate')";
                                if ($conn->query($sql) === TRUE) {
                                    echo "<li>New product added successfully.</li>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }

                            // delete product by name
                            if(isset($_GET['delete_product'])) {
                                $productName = $_GET['delete_product'];

                                // Delete the product from the database by name
                                $sql = "DELETE FROM pharmaceutical_products WHERE product_name='$productName'";
                                if ($conn->query($sql) === TRUE) {
                                    echo "<li>Product deleted successfully.</li>";
                                } else {
                                    echo "Error: " . $sql . "<br>" . $conn->error;
                                }
                            }

                                    // Display  products
                            $sql = "SELECT * FROM pharmaceutical_products";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    echo "<li>ID: {$row['product_id']} - Name: {$row['product_name']} - Price: {$row['price']} - Expiry Date: {$row['expiration_date']} <a href='modifyProducts.blade.php?delete_product={$row['product_name']}'>Delete</a></li>";
                                }
                            } else {
                                echo "No products available.";
                            }

                                        $conn->close();
                                        ?>
                        </ul>

                    </div>      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
