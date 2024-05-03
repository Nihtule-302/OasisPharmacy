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
                        
                        <h3 class="card-title">Modify Product</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Expiration Date</th>
                                    <th></th> <!-- Placeholder header for edit/delete -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr class="{{ Auth::check() && Auth::user()->role == 'admin' ? 'auth-visible' : '' }}">
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->price}}</td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->expiration_date}}</td>
                                    <td class="edit-delete-cell">
                                        <a href="{{route('edit-product', $product->id)}}">edit</a>
                                        &nbsp; &nbsp; &nbsp;
                                        <a href="{{route('delete-product', $product->id)}}" onclick="return confirm('Are you sure?')">delete</a>
                                    </td>
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

<style>
    table {
        width: 100%; /* Full-width table */
        border-collapse: collapse; /* Collapses borders between cells */
        margin: 20px 0; /* Margin above and below the table */
    }
    th, td {
        text-align: left; /* Align text to the left */
        padding: 8px; /* Padding in cells */
        border-bottom: 1px solid #bbb; /* Slightly darker gray border below each row */
    }
    th {
        background-color: #e0e0e0; /* Darker gray background for headers */
        color: #333; /* Dark text for visibility */
    }
    tr:hover {
        background-color: #d0d0d0; /* Even darker gray background on row hover */
    }
    .edit-delete-cell {
        visibility: hidden; /* Initially hidden */
    }
    .auth-visible .edit-delete-cell {
        visibility: visible; /* Only visible when an 'auth-visible' class is added via server-side or script */
    }
</style>