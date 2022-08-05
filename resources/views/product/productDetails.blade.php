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
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Product Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{$d->product_name}}" readonly >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Product Price') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{$d->price}}" readonly >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Product Description') }}</label>
                            <div class="col-md-6">
                                <textarea id="name" type="text" class="form-control" cols="30" rows="3" readonly>{{$d->description}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Product Category') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{$d->name}}" readonly >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Seller Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{$d->user_name}}" readonly >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Seller Email') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{$d->email}}" readonly >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Seller Area') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{$d->address}}" readonly >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-lg-end">{{ __('Created at') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" value="{{$d->created_at}}" readonly >
                            </div>
                        </div>

                </div>
                <div class="col-md-6">
                    <img src="{{asset('upload/products/2123574211.jpg')}}" alt="kk" style="width: 300px;height: 300px">
                    <br>
                    @if ($d->filenames != "")
                        @foreach(explode(',', $d->filenames) as $img)
                            <img  src="{{ asset('upload/products/'.$img)}}" alt="prod_img" style="width: 100px;height: 100px">
                        @endforeach
                    @endif

                    <div class="p-3">
                        <!-- Button trigger modal for hide-->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#hideModal">
                            Hide Product
                        </button>
                        <!-- Button trigger modal for delete-->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">
                            Delete Product
                        </button>
                        <button class="btn btn-secondary" onclick="history.back()">Go Back</button>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>



    <!-- Modal to delete-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Product!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-danger">
                    Ara you sure to delete {{$d->product_name}}!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, Cancel</button>
                    <a href="{{url('/dashboard/my-products/admin/delete-product/'.$d->id)}}"><button type="button" class="btn btn-danger">Yes, Delete</button></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to hide-->
    <div class="modal fade" id="hideModal" tabindex="-1" role="dialog" aria-labelledby="hideModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="hideModalLabel">Hide Product!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-danger">
                        Ara you sure to hide {{$d->product_name}}!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No, Cancel</button>
                    <button type="button" class="btn btn-danger">Yes, Hide</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection
