<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\SaleItem;
use App\Models\SaleList;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    //list Page
    function listSearchPage(Request $request){
        $data = "";

        $products = Products::select('products.id', 'products.name', 'sale_prices.sale_price')
                ->leftjoin('sale_prices', 'products.id', 'sale_prices.product_id')
                ->where('name', 'like', '%'.$request->searchValue.'%')
                ->get()
                ->groupBy('name');
        // logger($products);
        return $products;
    }

    //add Page
    function AddDataList(Request $request){
        // logger($request);
        // $productId = $request->productId;
        $userId = $request->userId;
        $productName = $request->productName;
        $productQty = $request->productQty;
        $productUnit = $request->productunit;
        $salePrice = $request->salePrice;
        $totalCost = $salePrice * $productQty;
        // logger($totalCost);

        $saleData = [
            // 'productId' => $productId,
            'user_id'=> $userId,
            'name' => $productName,
            'price' => $salePrice,
            'qty' => $productQty,
            'unit' => $productUnit,
            'total_cost' => $totalCost
        ];

        SaleItem::create($saleData);

        $getData = SaleItem::orderBy('id', 'desc')->get();
        // logger($getData);
        return $getData;
    }

    //add sale List
    function AddSaleList(Request $request){
        logger($request->all());

        foreach ($request->all() as $item) {
            SaleItem::where('user_id', $item['userId'])->delete();

            $total = 0;
            $data = SaleList::create([
                'user_id' => $item['userId'],
                'name' => $item['saleName'],
                'qty' => $item['saleQty'],
                'unit' => $item['saleUnit'],
                'price' => $item['salePrice'],
                'total_cost' => $item['saleTotalCost']
            ]);
            $total += $data->total_cost;
            logger($total);
        };

        return $request->all();


    }


    //addTable List
    // function addTableList(){
    //     $saleProduct = SaleItem::get();
    //     dd($saleProduct);
    // }
}
