<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Products;
use App\Models\SaleList;
use App\Models\SalePrice;
use Illuminate\Http\Request;
use App\Models\SaleProductlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PriceController extends Controller
{
    //mainPage
    public function mainPage(){
        // dd(Auth::user()->id);
        $listmain = SaleProductlist::select('sale_productlists.id', 'sale_productlists.name', 'sale_productlists.qty', 'products.qty as productQty', 'sale_productlists.price', 'shops.name as shop_name', 'sale_productlists.date')
        ->where('sale_productlists.user_id', Auth::user()->id)
        ->leftJoin('shops', 'sale_productlists.shop_id', 'shops.id')
        ->leftJoin('products', 'sale_productlists.name', 'products.name')
        ->latest('sale_productlists.date') // Order by date in descending order
        ->get()
        ->groupBy('name')
        ->map(function ($group) {
            return $group->first(); // Take only the first (latest) item from each group
        });


        // dd($listmain->toArray());
        $mostSaleList = SaleList::select('sale_lists.name as sale_list_name','sale_lists.user_id', 'sale_productlists.shop_id as sale_shop_id')
                    ->selectRaw('sale_lists.name, COUNT(*) as count')
                    ->where('sale_lists.user_id', Auth::user()->id)
                    ->leftjoin('sale_productlists', 'sale_lists.name', '=', 'sale_productlists.name')
                    ->groupBy('sale_lists.name', 'sale_lists.user_id','sale_productlists.shop_id')
                    ->selectRaw('sale_lists.name as sale_list_name, sale_productlists.shop_id as sale_shop_id')
                    ->get();
        // dd($mostSaleList->toArray());
        $shopName = Shop::select('name')
                    ->whereIn('shops.id', $mostSaleList->pluck('sale_shop_id')->unique())
                    ->where('shops.user_id', Auth::user()->id)
                    ->first();
        // dd($shopName);
        return view('adminuser.price.main', compact('listmain','mostSaleList','shopName'));
    }

    //detailPage
    public function detailPage($id){

        $product = SaleProductlist::select('name', 'category_id', 'price', 'small_package',)
                    ->where('id', $id)
                    ->first();
        // dd($product->toArray());
        $priceList = SaleProductlist::select('sale_productlists.price','sale_productlists.date','products.qty as productQty')
                    ->leftjoin('products', 'sale_productlists.name', '=', 'products.name')
                    ->orderBy('sale_productlists.id', 'desc')
                    ->where('sale_productlists.name', $product->name )
                    ->paginate(4);

        $smallPackageprice = SaleProductlist::select('sale_productlists.id as productId','sale_productlists.price', 'sale_productlists.qty', 'categories.name as category_name','products.qty as productQty')
                    ->leftjoin('categories', 'sale_productlists.category_id', 'categories.id')
                    ->leftjoin('products', 'sale_productlists.name', '=', 'products.name')
                    ->where('sale_productlists.id', $id)
                    ->first();
        // dd($smallPackageprice->productQty);

        $salePrice = SalePrice::select('sale_price', 'id')
                            ->where('product_id', $id)
                            ->latest('created_at')
                            ->first();
        // dd($salePrice);
        $BigPrice = $product->price/$smallPackageprice->productQty;

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
        $products = SaleProductlist::select('id','name')
                        ->where('user_id', Auth::user()->id)
                        ->get()
                        ->groupBy('name');
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
