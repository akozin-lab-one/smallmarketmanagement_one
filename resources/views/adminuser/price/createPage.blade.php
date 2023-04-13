@extends('adminuser.layouts.master')

@section('title', 'createPage')

@section('myContent')
@if (session('createSuccessprice'))
<div class="col-lg-6 offset-3">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="zmdi zmdi-mood"></i> <small>{{(session('createSuccessprice'))}}</small>
        <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
    <div class="container">
        <div class="card col-md-8 offset-md-2">
            <div class="card-body">
                <a class="text-decoration-none" href="{{route('price#mainpage')}}">Go Back</a>
                <h3 class="text-center">Sale Price</h3>
                <div class="form-group col-md-8 offset-md-2">
                    <form action="{{route('price#createdata')}}" method="post">
                        @csrf
                        <div class="form-group col-md-8 offset-md-2">
                            <label for="">Name</label>
                            <select class="form-control @error('productId') is-invalid @enderror" name="productId" id="">
                                <option value=""></option>
                                @foreach ($products as $p )
                                    <option value="{{$p->id}}">{{$p->name}}</option>
                                @endforeach
                            </select>
                            @error('productId')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group col-md-8 offset-md-2">
                            <label for="">Price</label>
                            <input class="form-control @error('salePrice') is-invalid @enderror" type="text" name="salePrice" id="">
                            @error('salePrice')
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
    </div>
@endsection
