@extends('layouts.app')

@section('content')
  <div class="container-fluid p-0 overflow-hidden">
      <div class="bg-image"">
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card bg-transparent border-0 shadow-lg">
                      <div class="card-header bg-transparent border-0 text-white">
                          <h2 class="mb-0"> Available Products</h2>
                      </div>

                      <div class="card-body bg-white-opacity">
                        <table>
                            <thead>
                              <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Expiration Date</th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach($products as $product)
                                <tr>
                                  <td>{{$product->product_name}}</td>
                                  <td>{{$product->price}}</td>
                                  <td>{{$product->description}}</td>
                                  <td>{{$product->expiration_date}}</td>


                                  @if(Auth::check() && Auth::user()->role == 'admin')
                                    <td>
                                      <a href='{{route("delete-product", $product->id)}}' onclick="return confirm('Are you sure?')">
                                        add to cart
                                      </a>&nbsp&nbsp&nbsp&nbsp

                                      <a href='{{route("edit-product", $product->id)}}'>
                                        edit
                                      </a> &nbsp&nbsp&nbsp&nbsp

                                      <a href='{{route("delete-product", $product->id)}}' onclick="return confirm('Are you sure?')">
                                        delete
                                      </a>
                                    </td>
                                  @endif
                                </tr>
                              @endforeach
                            </tbody>
                        </table>

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
