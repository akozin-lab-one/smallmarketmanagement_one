<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\SalePrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PriceController extends Controller
{
    //mainPage
    public function mainPage(){
        $list = Products::select('products.id','products.name','products.qty','products.price', 'shops.name as shop_name', 'products.date')
            ->leftjoin('shops', 'products.shop_id', 'shops.id')
            ->get()
            ->groupBy('name');
        // dd($list->toArray());
        return view('adminuser.price.main', compact('list'));
    }

    //detailPage
    public function detailPage($id){
        $product = Products::select('name', 'category_id', 'price', 'small_package',)
                    ->where('id', $id)
                    ->first();
        // dd($product->toArray());

        $priceList = Products::select('price','date','qty')
                    ->orderBy('id', 'desc')
                    ->where('name', $product->name )
                    ->paginate(4);
        // dd($priceList->toArray());
        $smallPackageprice = Products::select('products.id as productId','price', 'qty', 'categories.name as category_name')
                    ->leftjoin('categories', 'products.category_id', 'categories.id')
                    ->where('products.id', $id)
                    ->first();
        // dd($smallPackageprice->toArray());
        $salePrice = SalePrice::select('sale_price', 'id')
                            ->where('id', $id)->first();


        $BigPrice = $product->price/$smallPackageprice->qty;
        // dd($BigPrice);
        $smallprice = $product->small_package  == null ? " " : $BigPrice/$product->small_package;
        // dd($smallprice);

        $status = $smallPackageprice->category_name == 'coffee' || $smallPackageprice->category_name == 'ကော်ဖီ' || $smallPackageprice->category_name == 'tea' || $smallPackageprice->category_name == 'လက်ဖက်ရည်';
        if ($status){

            if (round($smallprice) < 200) {
                $smallPrice = 200;
            }else if(round($smallprice) >= 200){
                $smallPrice = 250;
            };

        };
        $result = $status == true ? $smallPrice : "";
        // dd($result);
        return view('adminuser.price.detail', compact('product','priceList', 'BigPrice', 'result','smallprice' , 'smallPackageprice', 'salePrice'));
    }

    //createPage
    public function createPage(){
        $products = Products::select('id','name')->get();
        // dd($product_name->toArray());
        return view('adminuser.price.createPage', compact('products'));
    }

    //createdata
    public function createData(Request $request){
        // dd($request->toArray());
        $this->validateRequestData($request);
        $data = $this->requestData($request);

        SalePrice::create($data);
        return back()->with(['createSuccessprice'=>'သင့်ရောင်းမည့်ကုန်အတွက် တန်ဖိုးသတ်မှတ်ခြင်းအောင်မြင်ပါသည်။']);
    }

    //validate
    private function validateRequestData($request){
        $validateRule = [
            'productId' =>'required',
            'salePrice' => 'required'
        ];
        Validator::make($request->all(), $validateRule)->validate();
    }

    //request data
    private function requestData($request){
        return [
            'product_id' => $request->productId,
            'sale_price' => $request->salePrice
        ];
    }
}
