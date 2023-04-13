@extends('adminuser.layouts.master')

@section('title', 'salelist')

@section('myContent')
    <div class="row">
        <div class="col-md-6 offset-md-3 d-flex justify-content-evenly">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h4>Item List</h4>
                            </div>
                            <div>
                                <i class="fa-solid fa-clipboard-list fs-3"></i>
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
                                <h4><span>Income</span></h4>
                            </div>
                            <div>
                                <i class="fa-solid fa-calendar-day fs-3"></i>
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
            <table class="table table-hover">
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
                <button class="btn btn-primary">
                    Proceed
                </button>
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
                        for (let $i = 0; $i < response.length; $i++) {
                            console.log(response[$i]);
                            $result =
                            `
                                <td id="productId">${response[$i].id}</td>
                                <td class="col-md-3" id="productName">${response[$i].name}</td>
                                <td class="col-md-2" ><input type="text" name="qty" id="productQty" class="form-control"></td>
                                <td class="col-md-2" ><input type="text" name="unit" id="productUnit" class="form-control"></td>
                                <td class="col-md-2">
                                    <select name="salePrice" id="salePrice" class="form-control">
                                        <option value=""></option>
                                        <option value="${response[$i].sale_price}">${response[$i].sale_price}</option>
                                    </select>
                                </td>
                                <td><button class="btn btn-primary" id="get-Data"><i class="fa-solid fa-plus"></i></button></td>;
                            `;
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
                $productId = $('#table-data').find("#productId").html();
                $productName = $('#table-data').find("#productName").html();
                $productqty = $('#table-data').find('#productQty').val();
                $productunit = $('#table-data').find('#productUnit').val();
                $salePrice = $('#table-data').find('#salePrice').val();
                console.log($productId);
                console.log($productName);
                console.log($productqty);
                console.log($productunit);
                console.log($salePrice);

                $data = {
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
                            $resultTable +=
                            `

                            <tr class="table-active">
                                <td>${result[$i].id}</td>
                                <td>${result[$i].name}</td>
                                <td>${result[$i].qty}</td>
                                <td>${result[$i].unit}</td>
                                <td>${result[$i].price}</td>
                                <td>${result[$i].total_cost }</td>
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

        })
    </script>
@endsection
