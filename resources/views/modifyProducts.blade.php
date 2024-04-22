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

                        <form method="POST" action="{{ route('save-product') }}" >
                            @csrf

                            <div class="row mb-3">
                                <label for="product_name" class="col-md-4 col-form-label text-md-end">{{ __('Product Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name">

                                    @error('product_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                
                            </div>

                            <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>
    
                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price">

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                
                            </div>

                            <div class="row mb-3">
                                <label for="expiration_date" class="col-md-4 col-form-label text-md-end">{{ __('Expiration Date	') }}</label>
    
                                <div class="col-md-6">
                                    <input id="expiration_date" type="date" class="form-control @error('expiration_date') is-invalid @enderror" name="expiration_date">

                                    @error('expiration_date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                
                            </div>

                            <div class="row mb-3">
                                <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
    
                                <div class="col-md-6">
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description">

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

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
