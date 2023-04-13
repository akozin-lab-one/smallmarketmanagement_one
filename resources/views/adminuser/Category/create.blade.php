@extends('adminuser.layouts.master')

@section('title', 'createPage')

@section('myContent')
    <div class="container">
        @if (session('successCategoryData'))
        <div class="col-lg-6 offset-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="zmdi zmdi-mood"></i> <small>{{(session('successCategoryData'))}}</small>
                <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        @endif
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <a href="{{route('adminuser#categorymain')}}" class="text-decoration-none">
                        Go Back
                    </a>
                    <h3 class="fw-bold text-center mt-3">Create category for your items</h3>
                    <form action="{{route('adminuser#categorycreatedata')}}" class="form-group p-3" method="POST">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 offset-md-3">
                                <label for="">Name</label>
                                <input type="text" name="name" id="" class="form-control  @error('name') is-invalid @enderror">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 offset-md-3 text-end mt-3">
                                <button class="btn btn-success" type="submit">proceed</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
