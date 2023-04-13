@extends('adminuser.layouts.master')

@section('title', 'adminmain')

@section('myContent')

    <div class="container">
        <div class="col-md-8 offset-md-2 d-flex justify-content-evenly">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Daily</h4>
                                <h5>76500 Kyats</h5>
                            </div>
                            <div>
                                <i class="fa-solid fa-calendar-day fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Monthly</h4>
                                <h5>1925000 Kyats</h5>
                            </div>
                            <div>
                                <i class="fa-solid fa-calendar-days fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-3">
            <div class="col-md-10 offset-md-1 d-flex justify-content-between">
                <div class="col-md-5">
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4>Profilt</h4>
                                    <h5>
                                        {{-- @php
                                            $total = 0;
                                        @endphp

                                        @foreach ($total_cost as $cost )
                                            $total += $cost->total_price;
                                        @endforeach
                                        {{$total}} Kyats --}}
                                    </h5>
                                </div>
                                <div>
                                    <i class="fa-solid fa-wallet fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fw-bold ms-auto">
                                        @php
                                            $res = 0;
                                        @endphp

                                        @foreach ($total as $item)
                                            @php
                                                $res += $item->total_price;
                                            @endphp
                                        @endforeach
                                        {{$res}}<span class="ms-1 fs-5">Kyats</span>
                                    </h3>
                                    <h4>Total Costs</h4>
                                </div>
                                <div>
                                    <i class="fa-solid fa-warehouse fs-3"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="fw-bold">Daily Income</h3>
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Item List</th>
                                <th scope="col">Sale Price</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="table-active">
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h3 class="fw-bold">Monthly Income</h3>
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">Month</th>
                                <th scope="col">Most Sale Item</th>
                                <th scope="col">Sale Price</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="table-active">
                                <td>Column content</td>
                                <td>Column content</td>
                                <td>Column content</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
