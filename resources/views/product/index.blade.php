@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>List All Products</h2>
            <hr>
            <div class="col-md-12">
                <p>
                    <a class="btn btn-primary" href="{{route('dashboard.addProduct')}}"><span class="glyphicon glyphicon-plus"></span> Add New Product</a>
                </p>


                <table class="table table-bordered table-hover">
                    <thead>
                    <th>#No.</th>
                    <th>Images</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                    </thead>
                    <tbody>
                    @if ($products->count() == 0)
                        <tr>
                            <td colspan="5">No products to display.</td>
                        </tr>
                    @endif
                    <tr>
                        @php
                            $i = 0
                        @endphp
                    </tr>

                    @foreach ($products as $product)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{ $product->filenames }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->price }} EGP</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <a class="btn btn-sm btn-success" href="#">Edit</a>
                                <a class="btn btn-sm btn-danger" href="#">Delete</a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                {{ $products->links('pagination::bootstrap-4') }}

                <p>
                    Displaying {{$products->count()}} of {{ $products->total() }} product(s).
                </p>

            </div>
        </div>
    </div>
@endsection
