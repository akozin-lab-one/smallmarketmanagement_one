@extends('layouts.master')

@section('title', 'register')

@section('myContent')
<form action="{{ route('register') }}" method="post" class="p-3">
    @csrf
    {{-- <h1 class="text-center text-uppercase fw-bold">Mini POS</h1>
     --}}
     <div class="text-center mb-3">
        <img class="img-fluid rounded border-0" style="width:150px; height:auto;" src="{{ asset('img/logo.jpeg') }}" alt="App logo">
    </div>
    <div class="col-md-8 offset-md-2">
        <label for="">Name</label>
        <input type="text" name="name" class="form-control"  id="">
    </div>
    @error('name')
        <small class="text-danger col-md-6 offset-md-2">{{$message}}</small>
    @enderror

    <div class="col-md-8 offset-md-2">
        <label for="">Email</label>
        <input type="text" name="email" class="form-control"  id="">
    </div>
    @error('email')
        <small class="text-danger col-md-6 offset-md-2">{{$message}}</small>
    @enderror

    <div class="col-md-8 offset-md-2">
        <label for="">Gender</label>
        <select name="gender" id="" class="form-control">
            <option value="">choose your gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
        </select>
    </div>
    @error('gender')
        <small class="text-danger col-md-6 offset-md-2">{{$message}}</small>
    @enderror

    <div class="col-md-8 offset-md-2">
        <label for="">Duration</label>
        <select name="duration" id="" class="form-control">
            <option value="">choose your duration</option>
            <option value="30">one month</option>
            <option value="90">three minths</option>
            <option value="180">six months</option>
            <option value="365">one year</option>
        </select>
    </div>
    @error('gender')
        <small class="text-danger col-md-6 offset-md-2">{{$message}}</small>
    @enderror

    <div class="col-md-8 offset-md-2">
        <label for="">Phone</label>
        <input type="text" name="phone" class="form-control" id="">
    </div>
    @error('phone')
        <small class="text-danger col-md-6 offset-md-2">{{$message}}</small>
    @enderror

    <div class="col-md-8 offset-md-2">
        <label for="">Address</label>
        <input type="text" name="address" class="form-control" id="">
    </div>
    @error('address')
        <small class="text-danger col-md-6 offset-md-2">{{$message}}</small>
    @enderror

    <div class="col-md-8 offset-md-2">
        <label for="">Password</label>
        <input type="password" name="password" class="form-control" id="">
        {{Auth::user()}}
    </div>
    @error('password')
        <small class="text-danger col-md-6 offset-md-2">{{$message}}</small>
    @enderror

    <div class="col-md-8 offset-md-2">
        <label for="">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" id="">
    </div>
    @error('password_confirmation')
        <small class="text-danger col-md-6 offset-md-2">{{$message}}</small>
    @enderror

    <div class="col-md-8 text-end offset-md-2 my-3">
        <button class="btn btn-success shadow-sm" type="submit">Register</button><br>
        <span>Already have an account?</span><a href="{{route('Auth#login')}}" class="text-decoration-none ms-1">Login</a>
    </div>
</form>
@endsection
