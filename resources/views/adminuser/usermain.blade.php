@extends('adminuser.layouts.master')

@section('title', 'adminmain')

@section('myContent')

    <div class="container">
        <div class="col-md-10 offset-md-1 d-flex justify-content-evenly">
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h1>
                                @if ($dailyInc != null)
                                    @php
                                        $result = 0;
                                        for ($i=0; $i < count($dailyInc) ; $i++) {
                                            $result += $dailyInc[$i]->total;
                                        }
                                    @endphp
                                        {{$result}}
                                @else
                                        0
                                @endif
                                    <span><h5 class="d-inline">Kyats</h5></span>
                                </h1>
                                <h4><span>Daily</span></h4>
                            </div>
                            <div>
                                <i class="fa-solid fa-calendar-day fs-3"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h1>
                                    @php
                                        $result = 0;

                                        for ($i=0; $i < count($monthlyInc) ; $i++) { 
                                            $result += $monthlyInc[$i]->total_cost;
                                        }
                                    @endphp
                                        {{$result}}
                                    <span><h5 class="d-inline">Kyats</h5></span>
                                </h1>
                                <h4>Monthly</h4>
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
                                    <h3 class="fw-bold ms-auto">

                                        @php
                                            $origin = 0;
                                        @endphp

                                        @foreach ($originalPrice as $op )

                                            @php
                                             $origin += $op->total;
                                            @endphp
                                        @endforeach

                                        @php
                                            $sale = 0;
                                        @endphp

                                        @foreach ($salePrice as $sa )
                                            @php
                                                $sale += $sa->total;
                                            @endphp
                                        @endforeach

                                        {{$sale - $origin}} <span class="ms-1 fs-5">Kyats</span>
                                    </h3>
                                    <h4>Profilt</h4>
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
                                {{-- @foreach ($daily as $d )
                                <tr class="table-active">
                                    <td>
                                        @for ($i=0; $i<count($d); $i++)
                                            {{$d[$i]->created_at->format('d-m-y')}}
                                        @endfor
                                    </td>
                                    <td>Column content</td>
                                    <td>Column content</td>
                                  </tr>
                                @endforeach --}}
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
                                <th scope="col">Total</th>
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
