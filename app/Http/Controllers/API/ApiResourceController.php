<?php

namespace App\Http\Controllers\API;

use App\Models\Shop;
use App\Models\Price;
use App\Models\Category;
use App\Models\Products;
use App\Models\SaleList;
use App\Models\SalePrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiResourceController extends Controller
{
    //productlist
    public function ProductList(){
        $products = Products::get();
        return response()->json($products, 200);
    }

    //category list
    public function CategoryList(){
        $category = Category::get();
        return response()->json($category, 200);
    }

    //shoplist
    public function ShopList(){
        $shop = Shop::get();
        return response()->json($shop, 200);
    }

    //pricelist
    public function PriceList(){
        $price = SalePrice::get();
        return response()->json($price, 200);
    }

    //saleProductList
    public function SaleProductList(){
        $saleList = SaleList::get();
        return response()->json($saleList, 200);
    }

    //create product
    public function CreateProduct(Request $request){
        // dd($request->all());
        $data = [
            "name" => $request->name,
            "category_id" => $request->category_id,
            "qty" => $request->qty,
            "unit" => $request->unit,
            "small_package" => $request->small_package,
            "price" => $request->price,
            "shop_id" => $request->shop_id,
            "Date" =>$request->Date
        ];
        $productCreate = Products::create($data);
        $product = Products::get();

        return response()->json($product, 200);
    }

    //createShop
    public function CreateShop(Request $request){
        // dd($request->all());
        $data = [
            "name" => $request->name,
            "address" => $request->address,
            "phone_number" => $request->phone_number
        ];

        $shopCreate = Shop::create($data);
        $shop = Shop::get();
        return response()->json($shop, 200);
    }

    //createcategory
    public function CreateCategory(Request $request){
        $data = [
            "name" => $request->name
        ];

        $categoryCreate = Category::create($data);
        $category = Category::get();

        return response()->json($category, 200);
    }

    //create price
    public function CreatePrice(Request $request){
        // logger($request->all());
        $data = [
            "product_id" => $request->productId,
            "sale_price" => $request->salePrice
        ];

        $pricecreate = SalePrice::create($data);
        $price = SalePrice::get();

        return response()->json($price, 200);
    }
}
