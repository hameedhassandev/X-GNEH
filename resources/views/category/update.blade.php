@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Update Category  : {{$category->name}} !</h2>
            <hr>
            <div class="col-md-6">
                <form action="{{ url('dashboard/accEdit-category').'/'.$category->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Category Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}" name="name" required >

                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="icon" class="col-md-4 col-form-label text-lg-end">{{ __('Category Icon') }}</label>

                        <div class="col-md-6">
                            <input id="icon" type="file"
                                   class="form-control @error('icon') is-invalid @enderror"
                                   name="icon"  accept="image/png, image/gif, image/jpeg"
                                   onchange="document.getElementById('categoryIcon').src = window.URL.createObjectURL(this.files[0])" >

                            @error('icon')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('Update Category') }}
                            </button>
                            <a class="btn btn-info" href="{{ route('dashboard.addCategory') }}">Cancel</a>

                        </div>
                    </div>
                </form>
                <hr>

            </div>
            <div class="col-6">
                <img src="{{ asset('upload/categories/'.$category->icon)}}" alt="category_icon" id="categoryIcon">

            </div>

        </div>
    </div>
@endsection
