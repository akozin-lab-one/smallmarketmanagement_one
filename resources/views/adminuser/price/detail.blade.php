@extends('adminuser.layouts.master')

@section('title', 'detailPage')

@section('myContent')
    <div class="container">
        <div>
            <a href="{{route('price#mainpage')}}" class="text-decoration-none p-3">
                Go Back
            </a>
        </div>
        <div class="col-md-8 offset-md-2">
            <h3 class="fw-bold">Original WholeSale Price</h3>
            <div class="row">
                <div class="col-md-3 border rounded">
                    <h4 class="p-2">Name</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            {{$product->name}}
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 border rounded">
                    <div class="col-md-7 offset-md-2">
                        <table class="table table-hover p-2">
                            <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Price</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($priceList as $p)
                                    <tr class="table-active">
                                        <td>
                                            @php
                                                $resultDate = date('d-m-y', strtotime($p->date));
                                            @endphp
                                            {{$resultDate}}
                                        </td>
                                        <td>
                                            {{round($p->price/$p->qty)}} <span>Kyats</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div>
                            {{$priceList->appends(request()->query())->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 offset-md-2 mt-3">
            <h3 class="fw-bold">Sale Price</h3>
            <div class="row">
                <div class="col-md-3 border rounded">
                    <h4 class="p-2">Name</h4>
                    <ul class="list-group">
                        <li class="list-group-item">
                            {{$product->name}}
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 border rounded">
                    <div class="col-md-8 offset-md-2">
                        <table class="table table-hover p-2">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Original Price</th>
                                <th scope="col">Sale Price</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr class="table-active">
                                    <td>
                                        အထုပ်ကြီး
                                    </td>
                                    <td>
                                        {{round($BigPrice)}} <span>Kyats</span>
                                    </td>
                                    <td>
                                        {{$salePrice->sale_price}} <span>Kyats</span>
                                    </td>
                                </tr>
                                @if ($smallPackageprice->category_name == 'coffee' || $smallPackageprice->category_name == 'ကော်ဖီ' || $smallPackageprice->category_name == 'tea' || $smallPackageprice->category_name == 'လက်ဖက်ရည်')
                                    <tr class="table-active">
                                        <td>
                                            အထုပ်သေး(တစ်ထုပ်)
                                        </td>
                                        <td>
                                            {{round($smallprice)}} <span>Kyats</span>
                                        </td>
                                        <td>
                                            {{round($result)}} <span>Kyats</span>
                                        </td>
                                    </tr>
                                    @if ($result > 200)
                                    <tr class="table-active">
                                        <td>
                                            တစ်တွဲ(ဆယ်ထုပ်)
                                        </td>
                                        <td>
                                            {{round($result) * 10 }} <span>Kyats</span>
                                        </td>
                                        <td>
                                            {{round($result) * 10 - 100}} <span>Kyats</span>
                                        </td>
                                    </tr>
                                    <tr class="table-active">
                                        <td>
                                            နှစ်တွဲနှင့်အထက်
                                        </td>
                                        <td>
                                            {{round($result)*10 }} <span>Kyats</span>
                                        </td>
                                        <td>
                                            {{round($result)*10 -300 }} <span>Kyats</span>
                                        </td>
                                    </tr>
                                    @else
                                    <tr class="table-active">
                                        <td>
                                            တစ်တွဲ(ဆယ်ထုပ်)
                                        </td>
                                        <td>
                                            {{round($result) * 10}} <span>Kyats</span>
                                        </td>
                                        <td>
                                            {{round($result) * 10 - 50}} <span>Kyats</span>
                                        </td>
                                    </tr>
                                    <tr class="table-active">
                                        <td>
                                            နှစ်တွဲနှင့်အထက်
                                        </td>
                                        <td>
                                            {{round($result)*10 }} <span>Kyats</span>
                                        </td>
                                        <td>
                                            {{round($result)*10 -100 }} <span>Kyats</span>
                                        </td>
                                    </tr>
                                    @endif
                                @elseif ($product->small_package  != null)
                                @if ($smallPackageprice->category_name == 'Drink' || $smallPackageprice->category_name == 'drink' ||$smallPackageprice->category_name == 'အအေး' )
                                <tr class="table-active">
                                    <td>
                                        တစ်ဗူး
                                    </td>
                                    <td>
                                        {{round($smallprice)}} <span>Kyats</span>
                                    </td>
                                    <td>
                                        {{round($smallprice) + 300}} <span>Kyats</span>
                                    </td>
                                </tr>
                                @else
                                <tr class="table-active">
                                    <td>
                                        အထုပ်သေး(တစ်ထုပ်)
                                    </td>
                                    <td>
                                        {{round($smallprice)}} <span>Kyats</span>
                                    </td>
                                    <td>
                                        {{round($smallprice) + 50}} <span>Kyats</span>
                                    </td>
                                </tr>
                                @endif
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('myAjaxList')
    <script>

    </script>
@endsection
