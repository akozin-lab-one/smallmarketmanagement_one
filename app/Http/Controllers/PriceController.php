<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\SalePrice;
use Illuminate\Http\Request;
use App\Models\SaleProductlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PriceController extends Controller
{
    //mainPage
    public function mainPage(){
        $list = SaleProductlist::select('sale_productlists.id','sale_productlists.name','sale_productlists.qty','sale_productlists.price', 'shops.name as shop_name', 'sale_productlists.date')
            ->leftjoin('shops', 'sale_productlists.shop_id', 'shops.id')
            ->get()
            ->groupBy('name');
        // dd($list->toArray());
        return view('adminuser.price.main', compact('list'));
    }

    //detailPage
    public function detailPage($id){
        // dd($id);
        $product = SaleProductlist::select('name', 'category_id', 'price', 'small_package',)
                    ->where('id', $id)
                    ->first();
        // dd($product->toArray());
        $priceList = SaleProductlist::select('price','date','qty')
                    ->orderBy('id', 'desc')
                    ->where('name', $product->name )
                    ->paginate(4);

        $smallPackageprice = SaleProductlist::select('sale_productlists.id as productId','price', 'qty', 'categories.name as category_name')
                    ->leftjoin('categories', 'sale_productlists.category_id', 'categories.id')
                    ->where('sale_productlists.id', $id)
                    ->first();
        // dd($smallPackageprice->toArray());

        $salePrice = SalePrice::select('sale_price', 'id')
                            ->where('product_id', $id)->first();
        // dd($salePrice->toArray());
        $BigPrice = $product->price/$smallPackageprice->qty;

        $smallprice = $product->small_package  == null ? " " : $BigPrice/$product->small_package;


        $status = $smallPackageprice->category_name == 'coffee' || $smallPackageprice->category_name == 'ကော်ဖီ' || $smallPackageprice->category_name == 'tea' || $smallPackageprice->category_name == 'လက်ဖက်ရည်';
        if ($status){

            if (round($smallprice) < 200) {
                $smallPrice = 200;
            }else if(round($smallprice) >= 200){
                $smallPrice = 250;
            };

        };
        $result = $status == true ? $smallPrice : "";
        return view('adminuser.price.detail', compact('product','priceList', 'BigPrice', 'result','smallprice' , 'smallPackageprice', 'salePrice'));
    }

    //createPage
    public function createPage(){
        $products = SaleProductlist::select('id','name')->get()->groupBy('name');
        return view('adminuser.price.createPage', compact('products'));
    }

    //createdata
    public function createData(Request $request){
        // dd($request->all());
        $this->validateRequestData($request);
        $data = $this->requestData($request);

        SalePrice::create($data);
        return back()->with(['createSuccessprice'=>'သင့်ရောင်းမည့်ကုန်အတွက် တန်ဖိုးသတ်မှတ်ခြင်းအောင်မြင်ပါသည်။']);
    }

    //validate
    private function validateRequestData($request){
        $validateRule = [
            'userId' => 'required',
            'productId' =>'required',
            'salePrice' => 'required'
        ];
        Validator::make($request->all(), $validateRule)->validate();
    }

    //request data
    private function requestData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'sale_price' => $request->salePrice
        ];
    }
}
