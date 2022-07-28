@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Manage Product</h2>
            <hr>
            <div class="col-md-8">
                <h4 class="text-center mt-4 mb-4">Add New Product</h4>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success" >
                        <p class="text-center">{{ $message }}</p>
                    </div>
                @endif
                @if ($message = Session::get('fail'))
                    <div class="alert alert-danger" >
                        <p class="text-center">{{ $message }}</p>
                    </div>
                @endif
                <form action="{{route('dashboard.storeProduct')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Product Name') }}</label>

                        <div class="col-md-6">
                            <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" required >

                            @error('product_name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Product Price') }}</label>

                        <div class="col-md-6">
                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required >

                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="category_id" class="col-md-4 col-form-label text-md-end">Choose Category</label>

                        <div class="col-md-6">
                            <select name="category_id" id="category_id" class="form-control" required>
                                <option value="" class="text-center">--Choose Category--</option>
                                @foreach ($categories as $category)
                                    <option class="text-center" value="{{ $category->id }}">"{{ $category->name }}"</option>">
                                @endforeach
                            </select>
                            {{--                                            <input id="category" type="" class="form-control @error('category') is-invalid @enderror" name="category" required>--}}

                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="icon" class="col-md-4 col-form-label text-lg-end">{{ __('Product Images (choose on or more)') }}</label>

                        <div class="col-md-6">
                            <input id="filenames" type="file" class="form-control @error('filenames') is-invalid @enderror" name="filenames[]" multiple="multiple"  accept="image/png, image/gif, image/jpeg" required >

                            @error('filenames')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('Add New Product') }}
                            </button>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
