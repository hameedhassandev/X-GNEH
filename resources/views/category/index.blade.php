@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Manage Category</h2>
            <hr>
            <div class="col-md-8">
                <h4 class="text-center mt-4 mb-4">Add New Category</h4>

                @if ($message = Session::get('success'))
                    <div class="alert alert-success" >
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <form action="{{route('dashboard.storeCategory')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Category Name') }}</label>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required >

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
                            <input id="icon" type="file" class="form-control @error('icon') is-invalid @enderror" name="icon"  accept="image/png, image/gif, image/jpeg" required >

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
                                {{ __('Add New Category') }}
                            </button>

                        </div>
                    </div>
                </form>
                <hr>
                <h4 class="text-center mt-4 mb-4">List All Categories</h4>
                <table class="table table-bordered">
                    <tr>
                        <th>#No.</th>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                    @php
                        $i = 0
                    @endphp
                    @foreach ($categories as $category)
                        <tr>

                            <td>{{++$i}}</td>
                            <td><img src="{{ asset('upload/categories/'.$category->icon)}}" style="width: 70px" alt="category_icon"></td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->created_at }}</td>
                            <td>

                                    <a class="btn btn-primary" href="{{ url('dashboard/edit-category').'/'.$category->id }}">Edit</a>

                                    <a class="btn btn-danger" href="{{ url('dashboard/delete-category').'/'.$category->id }}">Delete</a>

                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>
@endsection
