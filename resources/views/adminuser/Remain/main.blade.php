@extends('adminuser.layouts.master')

@section('title', 'RemainPage')

@section('myContent')
    <div style="height:100px;" class="d-flex justify-content-center">
        <div class="card bg-light align-middle w-75 mt-5">
            <h3 class="text-center my-3 text-decoration-underline">Remain Items</h3>
            @if(count($remain) != 0)
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Shop</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($remain as $re )
                            <tr class="table-active">
                                <td scope="row">{{$re->product_name}}</td>
                                <td>{{$re->category_name}}</td>
                                <td>{{$re->count_qty}}</td>
                                <td>{{$re->shop_name}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-3">
                        {{-- {{$cargo->appends(request()->query())->links()}} --}}
                    </div>
            @else
                <h3 class="text-secondary mt-5 text-center">There is no data in this list!</h3>
            @endif
        </div>
    </div>
@endsection
