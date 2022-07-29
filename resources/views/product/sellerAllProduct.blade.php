<style>
    span{
        color: #bb2d3b;
        font-weight: bold;
    }
</style>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>List My Products</h2>
            <hr>
            @foreach ($products as $p)
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6 p-3">
                    @if ($products->count() == 0)
                            <h4 class="text-center">No products to display.</h4>
                    @endif

                            <h4><span>Name : </span>{{$p->product_name}}</h4>
                            <h4><span>Price : </span> {{$p->price}} (EGP)</h4>
                            <h4> <span>Description : </span>{{$p->description}}</h4>
                            <h4> <span>Area : </span>{{$p->address}}</h4>
                            <h4><span>Category :</span> {{$p->name}}</h4>
                            <h4><span>Created At : </span>{{$p->created_at}}</h4>
                            <br>
                            <th class="p-2">
                                <a href="#" class="btn btn-primary">Hide Product</a>
                                <a href="#" class="btn btn-danger">Delete Product</a>
                                <a href="#" class="btn btn-success">Edit Product</a>
                            </th>
            </div>
            <div class="col-md-6">
                <h4><span>Product Image(s)</span></h4>
                @if ($p->filenames != "")
                    @foreach(explode(',', $p->filenames) as $img)
                        <img class="p-1"  src="{{ asset('upload/products/'.$img)}}" alt="prod_img" style="width: 150px;height: 150px">
                    @endforeach
                @endif
            </div>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
