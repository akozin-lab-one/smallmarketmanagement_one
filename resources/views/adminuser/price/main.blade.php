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

                    @foreach ($list as $li )
                        <tr class="table-active">
                            <td>

                                @php
                                $name = $li[0]->name;
                    
                                @endphp
                
                            @foreach ($li as $item)
                                @if ($item->qty === 0)
                                    @php
                                        $name = null; // Set to null if qty is zero
                                        break; // Exit the loop since qty is zero
                                    @endphp
                                @endif
                            @endforeach
                
                            @if ($name)
                                <a href="{{ route('price#detailPage', $li[0]->id) }}" class="text-decoration-none">
                                    {{ $name }}
                                </a>
                            @else
                                {{ $name }}
                                @php
                                    echo $li[0]->name;
                                @endphp
                            @endif
                
                            </td>
                            <td>

                                @php
                                $result = 0; // Initialize result outside the loop

                                for ($i = 0; $i < count($li); $i++) {
                                    // Check if qty is not zero before calculating
                                    if ($li[$i]->qty !== 0) {
                                        $result = round($li[$i]->price / $li[$i]->qty);
                                    }
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
