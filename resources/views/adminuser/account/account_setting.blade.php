@extends('adminuser.layouts.master')

@section('title', 'setting')

@section('myContent')
<div class="container d-flex justify-content-center align-items-center" style="height: 80vh">
    <div class="card bg-secondary mb-3 col-12 col-sm-6 col-md-6">
        <div class="text-center mt-2 fw-bold h3 text-dark">You can change your account password!</div>
        <div class="card-body">
            <form action="{{route('change#password')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label mt-4 text-white"> <i class="fa-solid fa-key text-white me-2"></i> Old Password</label>
                    <input type="password" name="oldpassword" class="form-control @error('oldpassword') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password">
                    @error('oldpassword')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label mt-4 text-white"><i class="fa-solid fa-key text-white me-2"></i>New Password</label>
                    <input type="password" name="newpassword" class="form-control @error('newpassword') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password">
                    @error('newpassword')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1" class="form-label mt-4 text-white"><i class="fa-solid fa-key text-white me-2"></i>Confirm Password</label>
                    <input type="password" name="confirmpassword" class="form-control @error('confirmpassword') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password">
                    @error('confirmpassword')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                  <div class="form-group mt-2 text-end me-2 d-flex justify-content-between">
                    <a class="text-decoration-none" href="{{route('password.request', Auth::user()->id)}}">Reset your password?</a>
                    <input type="submit" class="btn btn-success" value="Proceed">
                  </div>
            </form>
        </div>
      </div>
</div>
@endsection
