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
                                    <h2 class="fw-bold">
                                        @if (count($mostSaleList) !== 0)
                                        @php
                                            $maxCount = $mostSaleList->max('count');
                                            $itemWithMaxCount = $mostSaleList->where('count', $maxCount)->first();
                                        @endphp
                                        @if ($itemWithMaxCount)
                                             {{ $itemWithMaxCount->name }}
                                        @endif

                                        @else
                                            no product
                                        @endif
                                    </h2>
                                    <h4 class="">Most Sale Item</h4>
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
                                    <h2 class="fw-bold">
                                    @if ($shopName !== null)
                                        {{$shopName->name}}
                                    @else
                                        no Name
                                    @endif
                                    </h2>
                                    <h4 class="">
                                        Shop
                                    </h4>
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
            @if (count($listmain) !== 0)
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
                    @foreach ($listmain as $li )
                        <tr class="table-active">
                            <td>
                                @if ($li['qty'] !== 0)
                                    <a href={{route('price#detailPage', $li['id'])}}>{{$li['name']}}</a>
                                @else
                                    {{$li['name']}}
                                @endif

                            </td>
                            <td>
                                @php
                                    $result = $li['qty'] !== 0 ? $li['price']/$li['productQty'] : 0;
                                @endphp

                                {{ $result }} <span>Kyats</span>

                            </td>
                            <td>
                                {{$li['shop_name']}}
                            </td>
                            <td>

                            {{ $li['date'] }}

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection
