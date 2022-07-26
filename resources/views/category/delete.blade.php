@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text-danger">Delete Category  : {{$category->name}} !</h2>
            <hr>
            <div class="col-md-6">
                <h1 class="mt-4 mb-4">{{$category->name}}</h1>
                <hr>
                <p class="text-danger">delete this category will delete all product(s) related with this category !</p>
                <a class="btn btn-danger" href="{{ url('dashboard/accDelete-category').'/'.$category->id }}">Delete Category</a>
                <a class="btn btn-info" href="{{ route('dashboard.addCategory') }}">Cancel</a>

            </div>
            <div class="col-6">
                <img src="{{ asset('upload/categories/'.$category->icon)}}" alt="category_icon">

            </div>

        </div>
    </div>

@endsection
