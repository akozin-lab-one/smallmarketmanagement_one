@extends('adminuser.layouts.master')

@section('title', 'editPage')

@section('myContent')
    <div class="conteiner">
        <div class="card col-md-6 offset-md-3 p-3">
            <div class="card-body">
                <div class="text-start">
                    <a href="{{route('adminuser#shoplist')}}" class="text-decoration-none">
                        Go Back
                    </a>
                </div>
                <h3 class="fw-bold text-center ">Add Shops</h3>
                <form action="{{route('adminuser#edit')}}" class="form-group mt-2" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="hidden" name="ShopId" id="" value="{{$shopList->id}}">
                            <label for="">Name</label>
                            <input type="text" name="name" value="{{old('name', $shopList->name)}}" id="" class="form-control  @error('name') is-invalid @enderror">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Phone Number</label>
                            <input class="form-control  @error('phoneNumber') is-invalid @enderror" value="{{old('phoneNumber', $shopList->phone_number)}}" type="text" name="phoneNumber" id="">
                            @error('phoneNumber')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Address</label>
                        <textarea class="form-control  @error('address') is-invalid @enderror" placeholder="" name="address" id="" cols="30" rows="5">{{old('address', $shopList->address)}}</textarea>
                        @error('address')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group text-end my-3">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
