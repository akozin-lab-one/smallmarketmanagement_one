@extends('adminuser.layouts.master')

@section('title', 'createPage')

@section('myContent')
    @if (session('createProductsuccess'))
    <div class="col-lg-6 offset-3">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="zmdi zmdi-mood"></i> <small>{{(session('createProductsuccess'))}}</small>
            <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    <div class="col-md-6 offset-md-3">
        <div class="card">
            <a class="text-decoration-none p-3" href="{{route('product#mainpage')}}">Go back</a>
            <div class="card-body">
                <h3 class="fw-bold text-center">Create Products</h3>
                <form class="form-group" action="{{route('product#create')}}" method="post">
                    @csrf
                    <div class="form-group col-md-8 offset-md-2">
                        <label for="">Name</label>
                        <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="">
                        @error('name')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-8 offset-md-2">
                        <label for="">Category</label>
                        <select class="form-control @error('categoryId') is-invalid @enderror" name="categoryId" id="">
                            <option value=""></option>
                            @foreach ($categories as $category)
                               <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                        </select>
                        @error('categoryId')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group d-flex justify-content-between col-md-8 offset-md-2">
                        <div class="form-group col-md-5">
                            <label for="">Qty</label>
                            <input class="form-control @error('qty') is-invalid @enderror" type="text" name="qty" id="">

                            @error('qty')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-5">
                            <label for="">Unit</label>
                            <input class="form-control @error('unit') is-invalid @enderror" type="text" name="unit" id="">
                            @error('unit')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-8 offset-md-2">
                        <label for="">အထုပ်သေး</label>
                        <input class="form-control @error('smallPackage') is-invalid @enderror" type="text" name="smallPackage" id="">
                        @error('smallPackage')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-8 offset-md-2">
                            <label for="">Price</label>
                            <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" id="">
                            @error('price')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                    </div>
                    <div class="form-group col-md-8 offset-md-2">
                        <label for="">Shop</label>
                        <select class="form-control @error('shopId') is-invalid @enderror" name="shopId" id="">
                            <option value="">Please Choose shops</option>
                            @foreach ($shops as $shop)
                                <option value="{{$shop->id}}">{{$shop->name}}</option>
                            @endforeach
                        </select>
                        @error('shopId')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-8 offset-md-2 " id="">
                        <label for="">Date</label>
                        <input class="form-control datepicker @error('date') is-invalid @enderror" type="date" name="date" >
                        @error('date')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group col-md-8 offset-md-2 text-end my-3">
                        <button class="btn btn-success" type="submit">proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
