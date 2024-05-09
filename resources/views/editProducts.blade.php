@extends('layouts.app')

@section('content')
<!--Saif did all the divs-->
<div class="container-fluid p-0 overflow-hidden">
    <div class="bg-image"">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card bg-transparent border-0 shadow-lg">
                    <div class="card-header bg-transparent border-0 text-white">
                        <h2 class="mb-0">Management</h2>
                    </div>


                    <div class="card-body bg-white-opacity">
                        <h3 class="card-title">Edit Product</h3>

                        <form method="POST" action="{{ route('update-product',$product->id) }}" >
                            @csrf

                            <div class="row mb-3">
                                <label for="product_name" class="col-md-4 col-form-label text-md-end">{{ __('Product Name') }}</label>
    
                                <div class="col-md-6">
                                    <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $product->product_name }}" required>

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
                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required>

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
                                    <input id="expiration_date" type="date" class="form-control @error('expiration_date') is-invalid @enderror" name="expiration_date" value="{{ $product->expiration_date }}" required>

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
                                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $product->description }}" required>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                                
                            </div>

                            <div class="row mb-3">
                                <label for="quantity" class="col-md-4 col-form-label text-md-end">{{ __('Quantity') }}</label>
    
                                <div class="col-md-6">
                                    <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ $product->quantity }}" required>

                                    @error('quantity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit Product') }}
                                    </button>
                                </div>
                            </div>
                            
                        </form>
                    
                         
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
