<style>
    span{
        color: #0a53be;
        font-weight: bold;
    }
</style>
@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Product Details</h2>
            <hr>
            <div class="col-md-12">
                <div class="row">
                <div class="col-md-6">

               @foreach($details as $d)
                    <h4><span>Name : </span>{{$d->product_name}}</h4>
                    <h4><span>Price : </span> {{$d->price}} (EGP)</h4>
                        <h4> <span>Description : </span>{{$d->description}}</h4>
                    <h4><span>Category :</span> {{$d->name}}</h4>
                    <h4><span>Seller Name :</span> {{$d->user_name}}</h4>
                    <h4><span>Seller Email : </span>{{$d->email}}</h4>
                    <h4><span>Seller Area :</span> {{$d->address}}</h4>
                    <h4><span>Created At : </span>{{$d->created_at}}</h4>
                        <br>
                   <th>
                       <a href="#" class="btn btn-primary">Hide Product</a>
                       <a href="#" class="btn btn-danger">Delete Product</a>
                       <a href="{{route('dashboard.listProduct')}}" class="btn btn-secondary">Back</a>
                   </th>
                </div>
                <div class="col-md-6">
                    <h4><span>Product Image(s)</span></h4>
                    @if ($d->filenames != "")
                        @foreach(explode(',', $d->filenames) as $img)
                            <img  src="{{ asset('upload/products/'.$img)}}" alt="prod_img" style="width: 150px;height: 150px">
                        @endforeach
                    @endif
                </div>
                @endforeach
            </div>
            </div>
        </div>
    </div>
@endsection
