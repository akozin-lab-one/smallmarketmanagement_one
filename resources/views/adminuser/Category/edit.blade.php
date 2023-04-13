@extends('adminuser.layouts.master')

@section('title', 'editPage')

@section('myContent')
<div class="container">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-body">
                <a href="{{route('adminuser#categorymain')}}" class="text-decoration-none">
                    Go Back
                </a>
                <h3 class="fw-bold text-center mt-3">Create category for your items</h3>
                <form action="{{route('adminuser#editcategory')}}" class="form-group p-3" method="POST">
                    @csrf
                    <div class="row">
                        <div class="form-group col-md-6 offset-md-3">
                            <label for="">Name</label>
                            <input type="hidden" name="categoryId" value="{{$category->id}}">
                            <input type="text" name="name" value="{{$category->name}}" id="" class="form-control  @error('name') is-invalid @enderror">
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
