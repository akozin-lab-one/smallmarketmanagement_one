@extends('layouts.master')

@section('title', 'login')

@section('myContent')

<form action="{{ route('login') }}" method="post" class="p-3">
    @csrf
    {{-- <h1 class="text-center text-uppercase fw-bold">Mini POS</h1>--}}
    <div class="text-center mb-3">
        <img class="img-fluid rounded border-0" style="width:150px; height:auto;" src="{{ asset('img/logo.jpeg') }}" alt="App logo">
    </div>
    <div class="col-md-8 offset-md-2">
        <label for="">Email</label>
        <input type="text" name="email" class="form-control" id="">
    </div>
    @error('email')
        <small class="text-danger col-md-6 offset-md-2">{{$message}}</small>
    @enderror

    <div class="col-md-8 offset-md-2">
        <label for="">Password</label>
        <input type="password" name="password" class="form-control" id="">
    </div>
    @error('password')
    {{$message}}
        <small class="text-danger col-md-6 offset-md-2">{{$message}}</small>
    @enderror


    <div class="col-md-8 text-end offset-md-2 my-3">
        <button class="btn btn-success shadow-sm" type="submit">Login</button><br>
        <span>Already have an account?</span><a href="{{route('Auth#register')}}" class="text-decoration-none ms-1">Register</a>
    </div>
</form>

@error('expiredlogin')
{{-- {{$message}} --}}
<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <img src="..." class="rounded me-2" alt="...">
      <strong class="me-auto">Bootstrap</strong>
      <small class="text-body-secondary">just now</small>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
      See? Just like this.
    </div>
</div>
@enderror
@endsection
