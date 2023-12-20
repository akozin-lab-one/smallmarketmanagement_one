@extends('adminuser.layouts.master');

@section('title', 'mainPage')

@section('myContent')
    <div class="container">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fw-bold ms-3">{{count($cargoCounts)}}</h3>
                                    <h4>Cargo List</h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa-solid fa-clipboard-list fs-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h3 class="fw-bold ms-3">{{count($shop)}}</h3>
                                    <h4>Shops</h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa-regular fa-handshake fs-1 pe-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
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
                                    <h4>Total Spend</h4>
                                </div>
                                <div class="align-self-center">
                                    <i class="fa-solid fa-hand-holding-dollar fs-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between">
        <div class="form-group col-md-3 my-3 me-md-5">
            {{-- <select class="form-control" name="date" id="">
                <option value=""></option>
                @foreach ($cargo as $c )
                @php
                    $newDate = date('d-m-y', strtotime($c->Date))
                @endphp
                <option value="">{{$newDate}}</option>
                @endforeach
            </select> --}}
            <form action="{{route('product#mainpage')}}" class="d-flex" method="get">
                <input class="form-control" type="text" name="key" id="" value="{{request('key')}}">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
        </div>

        <div>
            <a href="{{route('product#createmain')}}" class="btn btn-success my-3 me-3">
                <i class="fa-solid fa-plus"></i>
            </a>
        </div>
    </div>
    <div class="data-table">
        @if(count($cargo) != 0)
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Name</th>
                <th scope="col">Category</th>
                <th scope="col">Qty</th>
                <th scope="col">Shop</th>
                <th scope="col">Price</th>
                <th scope="col">Date(cargo shopping)</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($cargo as $c )
                <tr class="table-active">
                    <th scope="row">{{$c->name}}</th>
                    <td>{{$c->category_name}}</td>
                    <td>{{$c->qty}} {{$c->unit}}</td>
                    <td>{{$c->shop_name}}</td>
                    <th>{{$c->price}} Kyats</th>
                    <td>
                        @php
                            $newDate = date('d-m-y', strtotime($c->Date))
                        @endphp

                        {{$newDate}}
                    </td>
                    <td>
                        <div>
                            <a href="{{route('product#editPage', $c->id)}}" class="btn btn-success">Edit</a>
                            <a href="{{route('product#delete', $c->id)}}">
                                <button class="btn btn-danger" type="button" id="liveToastBtn">
                                    Delete
                                </button>
                                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                                    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                                      <div class="toast-header">
                                        <button type="button" class="btn-close" data-mdb-dismiss="toast" aria-label="Close"></button>
                                      </div>
                                      <div class="toast-body">
                                        Hello, world! This is a toast message.
                                      </div>
                                    </div>
                                  </div>
                            </a>
                        </div>
                    </td>
                  </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{$cargo->appends(request()->query())->links()}}
        </div>
        @else
            <h3 class="text-secondary mt-5 text-center">There is no data in this list!</h3>
        @endif
    </div>
@endsection
