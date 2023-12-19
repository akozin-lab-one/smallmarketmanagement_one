@extends('adminuser.layouts.master')

@section('title', 'shopList')

@section('myContent')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h2>
                                        @if(count($total_cost))
                                        0 Kyats
                                    @else
                                        @php
                                            $total = 0;
                                            foreach ($total_cost as $cost) {
                                                $total += $cost->total_price;
                                            }
                                        @endphp
                                        {{$total}} Kyats
                                    @endif

                                    </h2>
                                    <h4>Total Cost</h4>
                                </div>
                                <div>
                                    <i class="fa-solid fa-hand-holding-dollar fs-1 me-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h2>
                                        @if ($shopList && (is_array($shopList) || $shopList instanceof Countable))
                                        {{ count($shopList) }}
                                    @else
                                        0
                                    @endif

                                    </h2>
                                    <h4>Total Shops</h4>
                                </div>
                                <div>
                                    <i class="fa-regular fa-handshake fs-1 me-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (session('deleteShopsuccess'))
        <div class="col-lg-6 offset-3 mt-3">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="zmdi zmdi-mood"></i> <small>{{(session('deleteShopsuccess'))}}</small>
                <button type="button" class="btn-close" data-mdb-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <div class="row my-3">
        <div class="col-md-10 offset-md-1">
            <div class="d-flex justify-content-end">
                <a href="{{route('adminuser#createPage')}}" class="btn btn-success">
                    <i class="fa-solid fa-plus"></i>
                </a>
            </div>
            @if ($shopList && (is_array($shopList) || $shopList instanceof Countable))
            <h3 class="fw-bold">Shop</h3>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($shopList as $shop )
                        <tr class="table-active">
                            <td>
                                <a href="{{route('adminuser#shopdetail', $shop->id)}}" class="text-decoration-none">
                                    {{$shop->name}}
                                </a>
                            </td>
                            <td>{{$shop->address}}</td>
                            <td>{{$shop->phone_number}}</td>
                            <td>
                                <a href="{{route('adminuser#editPage', $shop->id)}}" class="btn btn-success">Edit</a>
                                <a href="{{route('adminuser#delete', $shop->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <h3 class="fw-bold text-center mt-5">There is no Data for Shop List!!!</h3>
            @endif
        </div>
    </div>
@endsection
