@extends('adminuser.layouts.master')

@section('title', 'salelist')

@section('myContent')
    <div class="row">
        <div class="col-md-10 offset-md-1 d-flex justify-content-evenly">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h2 class="text-center">{{count($itemList)}}</h2>
                                <h4>Item List</h4>
                            </div>
                            <div>
                                <i class="fa-solid fa-clipboard-list fs-1"></i>
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
                                <h2>
                                    @php

                                        $result = 0;
                                        for ($i=0; $i < count($itemList) ; $i++) {
                                            # code...
                                            $result += $itemList[$i]->total;
                                        }
                                    @endphp
                                    {{$result}}
                                    <span><h5 class="d-inline">Kyats</h5></span>
                                </h2>
                                <h4><span>Income</span></h4>
                            </div>
                            <div>
                                <i class="fa-solid fa-calendar-day fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 offset-md-10 mt-md-3">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModal">
            Add
        </button>
        </div>
    <div class="mt-3">
        <div class="col-md-8 offset-md-2">
            <table class="table table-hover" id="dataTable">
                <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Unit</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total Cost</th>
                </tr>
                </thead>
                <tbody class="table-dataAdd" id="table-Add">

                </tbody>
            </table>
            <div class="float-end">
                <!-- Button trigger modal -->
                <button type="button" id="addBtn" class="btn btn-primary" data-mdb-toggle="modal" data-mdb-target="#exampleModalCenter">
                    Proceed
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Shwe Pinle</h5>
                        <button type="button" id="printClose" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                        <div class=" my-3">
                            <div class="col-md-3 float-end me-3">
                                <input type="text" class="form-control col-md-3 float-end" name="customerName" placeholder="Enter Customer Name">
                            </div>
                        </div>
                        <div class="modal-body">
                            <table class="table table-hover" >
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Cost</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody id="table-print">

                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Print <i class="fa-solid fa-print"></i></button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                    <div class="modal-title" id="exampleModalLabel">
                        <div class="d-flex">
                            <input type="text" name="name" class="searchValue">
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Price</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i< count($Products); $i++)
                                    <tr class="table-active" id="table-data">

                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('Ajaxpart')
    <script>
        $(document).ready(function(){
            $('.searchValue').on('keyup',function(){
                $value=$(this).val();
                console.log($value);

                $data = {
                    'searchValue' : $value
                };
                console.log($data);

                $.ajax({
                    type: 'get',
                    url:'ajax/list',
                    data:$data,
                    success:function(response){
                        console.log(response);
                        $result = ``;
                        for(let x in response){
                            console.log(response[x].length);
                            for (let $i = 0; $i < response[x].length; $i++) {
                                console.log(response[x][$i]);
                                $result =
                                    `
                                        <td class="d-none" >
                                            <input type="hidden" id="userId" name="" value="{{Auth::user()->id}}">
                                        </td>
                                        <td id="productId">
                                            ${response[x][$i].id}
                                        </td>
                                        <td class="col-md-3" id="productName">${response[x][$i].name}</td>
                                        <td class="col-md-2" ><input type="text" name="qty" id="productQty" class="form-control"></td>
                                        <td class="col-md-2" ><input type="text" name="unit" id="productUnit" class="form-control"></td>
                                        <td class="col-md-2">
                                            <select name="salePrice" id="salePrice" class="form-control">
                                                <option value=""></option>
                                                <option value="${response[x][$i].sale_price}">${response[x][$i].sale_price}</option>
                                            </select>
                                        </td>
                                        <td><button class="btn btn-primary" id="get-Data"><i class="fa-solid fa-plus"></i></button></td>;
                                    `;
                            }

                        }
                        $('#table-data').html($result);
                    },
                    error : function(request, status, error) {

                        var val = request.responseText;
                        console.log("error"+val);
                    },
                })

            })

            $('#table-data').click(function(){
                $userId = $('#table-data').find('#userId').val();
                $productId = $('#table-data').find("#productId").html();
                $productName = $('#table-data').find("#productName").html();
                $productqty = $('#table-data').find('#productQty').val();
                $productunit = $('#table-data').find('#productUnit').val();
                $salePrice = $('#table-data').find('#salePrice').val();
                console.log($userId);

                $data = {
                    'userId' : $userId,
                    'productId' : $productId,
                    'productName':$productName,
                    'productQty':$productqty,
                    'productunit':$productunit,
                    'salePrice':$salePrice
                };
                console.log($data);



                $.ajax({
                    type: 'get',
                    url:'ajax/add',
                    data:$data,
                    success:function(result){
                        console.log(result);
                        $resultTable = ``;
                        for(let $i =0; $i<result.length; $i++){
                            console.log(result[$i]);
                            cost = result[$i].qty * result[$i].price;
                            $resultTable +=
                            `

                            <tr class="table-active">
                                <td class="d-none" >
                                    <input type="hidden" id="userId" name="" value="{{Auth::user()->id}}">
                                </td>
                                <td id="saleId">${result[$i].id}</td>
                                <td id="saleName">${result[$i].name}</td>
                                <td id="saleQty">${result[$i].qty}</td>
                                <td id="saleUnit">${result[$i].unit}</td>
                                <td id="salePrice">${result[$i].price}</td>
                                <td id="saleTotalCost">${cost}</td>
                                <td>
                                    <a href="" class="btn btn-danger">
                                        Delete
                                    </a>
                                </td>
                            </tr>

                            `
                        }
                        $('#table-Add').html($resultTable);
                    }
                })

            })

            $('#addBtn').click(function(){

                $saleList = [];
                $('#dataTable tbody tr').each(function(index, row){
                    $saleList.push({
                        'userId' : $(row).find('#userId').val(),
                        'saleName': $(row).find('#saleName').html(),
                        'saleQty' : $(row).find('#saleQty').html(),
                        'saleUnit' : $(row).find('#saleUnit').html(),
                        'salePrice' : $(row).find('#salePrice').html(),
                        'saleTotalCost' : $(row).find('#saleTotalCost').html()
                    });
                });
                console.log($saleList);

                $.ajax({
                    type: 'get',
                    url:'ajax/addsalelist',
                    data:Object.assign({}, $saleList),
                    success:function(response){
                        $resultTable = ``;
                        $('#table-Add').html($resultTable);
                        console.log(response);

                        $printTable = ``;
                        for(let $i =0; $i<response.length; $i++){
                            console.log(response[$i]);
                            cost = response[$i].saleQty * response[$i].salePrice;
                            $printTable +=
                            `
                            <tr class="table-active">
                                <td >${response[$i].userId}</td>
                                <td >${response[$i].saleName}</td>
                                <td >${response[$i].saleQty}</td>
                                <td >${response[$i].saleUnit}</td>
                                <td >${response[$i].salePrice}</td>
                                <td >${cost}</td>
                            </tr>
                            `
                        }
                        $('#table-print').html($printTable);
                    }
                })
            })

            $('#printClose').click(function(){
                $printTable =  ``;
                $('#table-print').html($printTable);
            })
        })
    </script>
@endsection
