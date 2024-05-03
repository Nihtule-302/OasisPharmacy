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

                        <br>
                        <br>

                        <h3 class="card-title">Modify Product</h3>
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
                                        <!--
                                      <a href='{{route("edit-product", $product->id)}}'>
                                        edit
                                      </a> &nbsp&nbsp&nbsp&nbsp
                                    -->
                                      <a href='{{route("delete-product", $product->id)}}' onclick="return confirm('Are you sure?')">
                                        delete
                                      </a>
                                    </td>
                                  @endif
                                </tr>
                              @endforeach
                            </tbody>
                        </table>

                        
                        

                    </div>      
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
