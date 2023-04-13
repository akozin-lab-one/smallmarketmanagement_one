<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    //mainPage
    public function mainPage(){
        $total = Products::select(DB::raw('SUM(price) as total_price'))
                ->groupBy('category_id')
                ->get();
        return view('adminuser.usermain', compact('total'));
    }


    //mainPage
    public function cargoMainPage(){
        $shop = Shop::get();
        $cargo = Products::select('products.*', 'categories.name as category_name', 'shops.name as shop_name')
                ->when(request('key'), function($q){
                    $q->where('products.name', 'like', '%'.request('key').'%');
                })
                ->orderBy('id','desc')
                ->leftjoin('categories', 'products.category_id', 'categories.id')
                ->leftjoin('shops', 'products.shop_id', 'shops.id')
                ->paginate(4);
        $total = Products::select(DB::raw('SUM(price) as total_price'))
                ->groupBy('category_id')
                ->get();
        return view('adminuser.Products.main', compact('shop', 'cargo', 'total'));
    }

    //createPage
    public function createMainPage(){
        $shops = Shop::get();
        $categories = Category::get();
        return view('adminuser.Products.create', compact('categories', 'shops'));
    }

    //create
    public function createData(Request $request){
        $this->validateRequestData($request);
        $data = $this->requestData($request);

        // dd($data);
        Products::create($data);
        return back()->with(['createProductsuccess' => 'သင့်ဆိုင်အတွက် ရောင်းကုန်ပစည်းတစ်ခု စာရင်းသွင်းပြီးပါပြီ။ အသေးစိတ်ကြည့်ရှု့ရန် မူလစာမျက်နှာသို့သွားပေးပါ။']);
    }

    //editPage
    public function editPage($id){
        $products = Products::where('id', $id)->first();
        $categories = Category::get();
        $shops = Shop::get();
        return view('adminuser.Products.edit', compact('products', 'categories', 'shops'));
    }

    //edit
    public function editData(Request $request){
        $this->validateRequestData($request);
        $data = $this->requestData($request);

        Products::where('id', $request->productId)->update($data);
        return redirect()->route('product#mainpage');
    }

    //delete
    public function deleteData($id){
        Products::where('id', $id)->delete();
        return back()->with(['deleteProductSuccess'=>'သင့်ပစည်းကို အရောင်းစာရင်းမှ ပယ်ဖျက်ြခင်း အောင်မြင်ပါသည်။']);
    }

    //validate data
    private function validateRequestData(Request $request){
        $validateRule = [
            'name' => 'required',
            'categoryId' => 'required',
            'qty' => 'required',
            'price' => 'required',
            'shopId' => 'required',
            'date' => 'required'
        ];
        Validator::make($request->all(), $validateRule)->validate();
    }

    //request
    private function requestData(Request $request){
        return[
            'name' => $request->name,
            'category_id' => $request->categoryId,
            'qty' =>$request->qty,
            'unit' => $request->unit,
            'small_package' => $request->smallPackage,
            'price' => $request->price,
            'shop_id' =>$request->shopId,
            'date' => $request->date
        ];
    }
}
