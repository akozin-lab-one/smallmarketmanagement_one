@extends('superuser.layouts.master')

@section('title', 'detail')

@section('myContent')
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1 mt-5">
                <div class="row shadow-sm">
                    <div class="col-md-6 ps-5 py-3">
                        <div class="row">
                            <a href="{{route('Super#dashboard')}}" class="text-decoration-none mb-3 text-dark">Go Back</a>
                        </div>
                            <img src="data:image/jpeg;base64,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" alt="" class="img-thumbnail w-75 h-75" style="width:100px; height:100px;">
                    </div>
                    <div class="col-md-6">
                        <form action="" method="post" class="col-md-10 offset-md-1 p-5">
                            <div class="form-group">
                                <label for="" class="fw-bold">Name</label>
                                <input type="text" value="{{$personDetail->name}}" name="" id="" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="" class="fw-bold">Email</label>
                                <input type="text" value="{{$personDetail->email}}" name="" id="" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="" class="fw-bold">Gender</label>
                                <select name="" id="" class="form-control" disabled>
                                    <option value="male" @if ($personDetail->role == 'male') selected @endif>Male</option>
                                    <option value="female" @if ($personDetail->role == 'female') selected @endif>Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="fw-bold">Phone</label>
                                <input type="text" value="{{$personDetail->phone}}" name="" id="" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="" class="fw-bold">Address</label>
                                <input type="text" value="{{$personDetail->address}}" name="" id="" class="form-control" disabled>
                            </div>
                            <div class="form-group">
                                <label for="" class="fw-bold">Role</label>
                                <select name="" id="" class="form-control" disabled>
                                    <option value="admin" @if ($personDetail->role == 'admin') selected @endif>Admin</option>
                                </select>
                            </div>
                            <div class="form-group mt-3 text-end">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success" data-mdb-toggle="modal" data-mdb-target="#staticBackdrop">
                                    Set Info
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="staticBackdrop" data-mdb-backdrop="static" data-mdb-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Set DateTime For Application Usage</h1>
                                        <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-8 offset-md-2">
                                                    <div class="col-md-6 offset-md-3">
                                                        <form action="" class="form-control">
                                                            <div class="form-group">
                                                                <label for="">From Date</label>
                                                                <input class="form-control" type="text" name="" value="{{$personDetail->created_at->format('d-m-y')}}" id="" disabled>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="" class="fw-bold">Set Date</label>
                                                                <input type="date" name="dateTime" id="" class="form-control">
                                                            </div>
                                                            <div class="form-group">
                                                                <button type="submit" class="btn btn-success my-3">Save</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Understood</button>
                                        </div> --}}
                                    </div>
                                    </div>
                                </div>

                                <a href="{{route('Super#editPage', $personDetail->id)}}" class="btn btn-success">
                                    Edit
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
