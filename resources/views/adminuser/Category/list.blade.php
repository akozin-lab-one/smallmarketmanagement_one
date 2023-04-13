@extends('adminuser.layouts.master')

@section('title', 'categoryPage')

@section('myContent')
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <h3 class="fw-bold my-3 text-center">Category For Item</h3>
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <a href="{{route('adminuser#categorycreate')}}">
                            <button class="btn btn-success" type="submit"><i class="fa-solid fa-plus"></i></button>
                        </a>
                    </div>
                    @if ( count($category) != 0 )
                    <table class="table table-hover p-3">
                        <thead>
                          <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date</th>
                          </tr>
                        </thead>
                        <tbody>
                                @foreach ($category as $item )
                                    <tr class="table-active">
                                        <th scope="row">{{$item->id}}</th>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->created_at->format('j-m-y')}}</td>
                                        <td>
                                            <div>
                                                <a href="{{route('adminuser#categoryeditPage', $item->id)}}">
                                                    <button class="btn btn-success" type="submit">Edit</button>
                                                </a>
                                                <a href="{{route('adminuser#categorydelete', $item->id)}}">
                                                    <button class="btn btn-danger" type="submit">Delete</button>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                    @else
                        <h1 class="fw-bold">There is no data for category</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
