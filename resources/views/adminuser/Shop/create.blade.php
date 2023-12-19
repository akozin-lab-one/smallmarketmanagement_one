@extends('adminuser.layouts.master')

@section('title', 'createPage')

@section('myContent')
    <div class="container">
        @if (session('createShopsuccess'))
            <div class="col-lg-6 offset-3">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="zmdi zmdi-mood"></i> <small>{{(session('createShopsuccess'))}}</small>
                    <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif
        <div class="card col-md-6 offset-md-3 p-3">
            <div class="card-body">
                <div class="text-start">
                    <a href="{{route('adminuser#shoplist')}}" class="text-decoration-none">
                        Go Back
                    </a>
                </div>
                <h3 class="fw-bold text-center ">Add Shops</h3>
                <form action="{{route('adminuser#create')}}" class="form-group mt-2" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="">Name</label>
                            <input type="text" name="name" id="" class="form-control  @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Phone Number</label>
                            <input type="hidden" name="userId" value="{{Auth::user()->id}}" id="">
                            <input class="form-control  @error('phoneNumber') is-invalid @enderror" type="text" name="phoneNumber" id="">
                            @error('phoneNumber')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea class="form-control  @error('address') is-invalid @enderror" name="address" id="" cols="30" rows="5"></textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group text-end my-3">
                        <button type="submit" class="btn btn-success">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
