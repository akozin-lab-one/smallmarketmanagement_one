@extends('adminuser.layouts.master')

@section('title', 'detailShop')

@section('myContent')
    <div class="container mt-5">
        <div class="col-md-8 offset-md-2">
            <div class="card p-3">
                <div class="card-body">
                    <div>
                        <a href="{{route('adminuser#shoplist')}}" class="text-decoration-none my-2">Go Back</a>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://cdn.pixabay.com/photo/2013/07/13/11/31/shop-158317_960_720.png" alt="" class="img-thumbnail">
                        </div>
                        <div class="col-md-6">
                            <div class="p-3">
                                <div>
                                    <span class="d-inline">Name :</span><h3 class="fw-bold">{{$shopDetail->name}}</h3>
                                </div>
                                <div>
                                    <span>Phone :</span><p class="text-dark">{{$shopDetail->phone_number}}</p>
                                </div>
                                <div>
                                    <span>Address :</span><p class="text-dark">{{$shopDetail->address}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
