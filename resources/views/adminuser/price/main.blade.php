@extends('adminuser.layouts.master')

@section('title', 'mainPage')

@section('myContent')
    <div class="container">
        <div class="col-md-8 offset-md-2">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h2 class="fw-bold">DingWang</h2>
                                    <h4 class="">Most Sale Items</h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa-regular fa-star fs-1"></i>
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
                                    <h2 class="fw-bold">Points</h2>
                                    <h4 class="">Shop</h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa-regular fa-handshake fs-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="me-5">
        <a href="{{route('price#createPage')}}" class="btn btn-primary float-end">
                <i class="fa-solid fa-plus"></i>
        </a>
    </div>
    <div class="container">
        <div class="col-md-10 offset-md-1 mt-2">
            @if (count($list) != 0)
            <h3 class="fw-bold">Initial Price</h3>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Shop</th>
                    <th scope="col">Shopping Date</th>
                </tr>
                </thead>
                <tbody>
                    {{$list}}
                    @foreach ($list as $li )
                    {{$li}}
                        <tr class="table-active">
                            <td>
                                @php
                                    for ($i=0; $i < count($li) ; $i++) {
                                        $result = $li[$i];
                                    }
                                @endphp
                                <a href="{{route('price#detailPage', $result->id)}}" class="text-decoration-none">
                                    {{$result->name}}
                                </a>
                            </td>
                            <td>
                                @php
                                    for ($i=0; $i < count($li) ; $i++) {
                                        $result = round($li[$i]->price/$li[$i]->qty);
                                    }
                                @endphp
                                {{$result}} <span>Kyats</span>
                            </td>
                            <td>{{$li[0]->shop_name}}</td>
                            <td>
                                @php
                                    for ($i=0; $i < count($li); $i++) {
                                        $result = date('d-m-y', strtotime($li[$i]->date));
                                    }
                                @endphp
                                {{$result}}
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
