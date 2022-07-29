@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>List All Active Products</h2>
            <hr>
            <div class="col-md-12">



                <table class="table table-bordered table-hover">
                    <thead>
                    <th>No.</th>
                    <th>Product Name</th>
                    <th>Product Price (EGP)</th>
                    <th>Product Description</th>
                    <th>Created at</th>
                    <th>Seller Name</th>
                    <th>Category Name</th>
                    <th>Actions</th>
                    </thead>
                    <tbody>
                    @if ($products->count() == 0)
                        <tr>
                            <td class="text-center" colspan="8">No products to display.</td>
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
{{--                            <td>{{ json_encode($product->filenames,true)  }}</td>--}}
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->price }}</td>
                            <td>{{ $product->description }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->user_name }}</td>
                            <td>{{ $product->name }}</td>

                                <td>
                                    <a href="{{url('/dashboard/list-products/product-details/'.$product->id)}}">more details</a>

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
