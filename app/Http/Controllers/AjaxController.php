<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\SaleItem;
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
        logger($products);
        return $products;
    }

    //add Page
    function AddDataList(Request $request){
        // $productId = $request->productId;
        $productName = $request->productName;
        $productQty = $request->productQty;
        $productUnit = $request->productunit;
        $salePrice = $request->salePrice;
        $totalCost = $salePrice * $productQty;
        // logger($totalCost);

        $saleData = [
            // 'productId' => $productId,
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

    //addTable List
    // function addTableList(){
    //     $saleProduct = SaleItem::get();
    //     dd($saleProduct);
    // }
}
