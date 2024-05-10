@extends('layouts.app')

@section('content')
  <div class="container-fluid p-0 overflow-hidden">
      <div class="bg-image">
          <div class="row justify-content-center">
              <div class="col-md-8">
                  <div class="card bg-transparent border-0 shadow-lg">
                      <div class="card-header bg-transparent border-0 text-white">
                          <h2 class="mb-0">Available Products</h2>
                      </div>

                      <div class="card-body bg-white-opacity">
                        <table>
                            <thead>
                              <tr>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Expiration Date</th>
                                <th>Quantity</th>
                                <th></th>
                              </tr>
                            </thead>

                            <tbody>
                              @foreach($products as $product)
                                  <tr>
                                      <td>{{ $product->product_name }}</td>
                                      <td>{{ $product->price }}</td>
                                      <td>{{ $product->description }}</td>
                                      <td>{{ $product->expiration_date }}</td>
                                      <td>{{ $product->quantity }}</td>
                                      
                                      @php 
                                          $currentItem = $items->firstWhere('product_id', $product->id); 
                                          $quantityInCart = $currentItem ? $currentItem->quantity : 0;
                                      @endphp

                                      @auth
                                          <td>
                                              @if ($product->quantity == 0)
                                                  <span style="color: red;">Out of Stock</span>
                                              @else
                                                  <form class ="addToCartForm" action="{{ route('add-to-cart', $product->id) }}" method="POST">
                                                      @csrf
                                                      <input type="number" value="{{ $quantityInCart }}" name="quantity" min="1" max="{{ $product->quantity }}">
                                                      <button type="submit" style="border: none; background: none; color: blue;">Add to Cart</button>
                                                  </form>
                                              @endif
                                          </td>
                                      @endauth
                                  </tr>
                              @endforeach
                            </tbody>
                        </table>

                        <div id="successMessage">
                              <p></p>
                        </div>

                        <br>

                        <a href="{{ route('cart') }}" class="view-cart-link">View Cart</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
   </div>

   <!-- Add some styles for the modal -->
   <style>
      .modal-message {
          position: fixed;
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
          background-color: white;
          border: 1px solid #ddd;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
          padding: 20px;
          z-index: 1000;
          display: none;
      }
   </style>

   <!-- Add the JavaScript to hide the modal after a few seconds -->
   <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Include jQuery library -->

   <script>
       $(document).ready(function() {
           // Function to fetch products data via AJAX
           function fetchProducts() {
               $.ajax({
                   url: '{{ route("view-products") }}', // Adjust the URL as per your route configuration
                   type: 'GET',
                   success: function(response) {
                       // Update the container with the fetched HTML
                       $('#products-container').html(response);
                   },
                   error: function(xhr, status, error) {
                       // Handle errors
                       console.error(error);
                   }
               });
           }
   
           // Intercept form submission
           $('.addToCartForm').submit(function(event) {
               // Prevent default form submission
               event.preventDefault();
   
               // Extract form data
               var formData = $(this).serialize();
   
               // Send AJAX request
               $.ajax({
                   url: $(this).attr('action'),
                   type: $(this).attr('method'),
                   data: formData,
                   success: function(response) {
                        
                        $('#successMessage').text("added to cart successfully");

                        setTimeout(function() {
                            $('#successMessage').empty();
                        }, 2000);
                                
                        fetchProducts();
                    },
                   error: function(xhr, status, error) {
                       // Handle errors
                       console.error(error);
                   }
               });
           });
   
           // Call the fetchProducts function when the page loads
           fetchProducts();
       });
   </script>
   
@endsection
