<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Shop;
use App\Models\Daily;
use App\Models\monthly;
use App\Models\Category;
use App\Models\Products;
use App\Models\SaleList;
use Illuminate\Http\Request;
use App\Models\SaleProductlist;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    //mainPage
    public function mainPage(){
        $total = Products::select(DB::raw('SUM(price) as total_price'))
                ->where('user_id', Auth::user()->id)
                ->groupBy('category_id')
                ->get();
        // dd($total->toArray());
        $dailyInc = SaleList::select('created_at',DB::raw('SUM(total_cost) as total'))
                    ->whereDate('created_at', Carbon::today()->toDateString())
                    ->where('user_id', Auth::user()->id)
                    ->groupBy('created_at')
                    ->get();
        // dd($dailyInc->toArray());
        $monthlyInc = SaleList::select('name', DB::raw('count(name) as count_name'), DB::raw('SUM(total_cost) as total'))
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->where('user_id', Auth::user()->id)
                        ->groupBy('name')
                        ->get();
        // dd($monthlyInc->toArray());
        $monthInc = monthly::select('month', DB::raw('MAX(most_sale_item) as most'), DB::raw('MAX(total) as month_total'))
                            ->where('user_id', Auth::user()->id)
                            ->groupBy('month')
                            ->get();



        $originalPrice = Products::select('name', DB::raw('SUM(price) as total'))
                                    ->where('user_id', Auth::user()->id)
                                    ->groupBy('name')
                                    ->get();

        $salePrice = SaleList::select('name', DB::raw('SUM(total_cost) as total'))
                                    ->where('user_id', Auth::user()->id)
                                    ->groupBy('name')
                                    ->get();

        $daily = Daily::select('date',DB::raw('MAX(daily_total) as total'), DB::raw('MAX(item_list) as item'))
                            ->where('user_id', Auth::user()->id)
                            ->groupBy('date')
                            ->get();
        // dd($daily->toArray());
        return view('adminuser.usermain', compact('total', 'dailyInc', 'monthlyInc', 'originalPrice', 'salePrice', 'daily', 'monthInc'));
    }


    //mainPage
    public function cargoMainPage(){
        // dd(Auth::user()->id);
        $shop = Shop::where('user_id', Auth::user()->id)->get();
        $cargo = Products::select('products.*', 'categories.name as category_name', 'shops.name as shop_name')
                ->when(request('key'), function($q){
                    $q->where('products.name', 'like', '%'.request('key').'%');
                })
                ->orderBy('id','desc')
                ->where('products.user_id', Auth::user()->id)
                ->leftjoin('categories', 'products.category_id', 'categories.id')
                ->leftjoin('shops', 'products.shop_id', 'shops.id')
                ->paginate(4);
                $cargoCounts = Products::groupBy('name')
                ->where('user_id', Auth::user()->id)
                ->select('name', \DB::raw('count(*) as count'))
                ->get();
        // dd($cargoCounts->toArray());
        $total = Products::select(DB::raw('SUM(price) as total_price'))
                ->where('user_id', Auth::user()->id)
                ->groupBy('category_id')
                ->get();

        $productCostsByMonth = DB::table('products')
                            ->select(
                                DB::raw('YEAR(created_at) as year'),
                                DB::raw('MONTH(created_at) as month'),
                                'name',
                                DB::raw('SUM(price) as total_cost')
                            )
                            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'), 'name')
                            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
                            ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
                            ->orderBy('name', 'asc')
                            ->get();

        return view('adminuser.Products.main', compact('shop','cargoCounts', 'cargo', 'total'));
    }

    //createPage
    public function createMainPage(){
        $shops = Shop::where('user_id', Auth::user()->id)->get();
        $categories = Category::where('user_id', Auth::user()->id)->get();
        return view('adminuser.Products.create', compact('categories', 'shops'));
    }

    //create
    public function createData(Request $request){
        // dd($request->toArray());
        $this->validateRequestData($request);
        $data = $this->requestData($request);

        // dd($data);
        Products::create($data);
        $lastAddedProduct = SaleProductlist::where('name', $data['name'])
                        ->orderBy('created_at', 'desc') // Assuming there's a timestamp to determine the order
                        ->first();

        if ($lastAddedProduct) {
            // Calculate the new quantity based on the last added item's quantity
            $newQty = $lastAddedProduct->qty + $data['qty'];

            // Update the existing record with the new quantity
            $lastAddedProduct->update(['qty' => $newQty]);
        }else{
            // dd($data);
            SaleProductlist::create($data);
        }
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
        // dd($request->toArray());
        $this->validateRequestData($request);
        $data = $this->requestData($request);

        Products::where('id', $request->productId)->update($data);
        return redirect()->route('product#mainpage');
    }

    //delete
    public function deleteData($id){
        Products::where('id', $id)->delete();
        return back()->with(['deleteProductSuccess'=>'သင့်ပစည်းကို အရောင်းစာရင်းမှ ပယ်ဖျက်ခြင်း အောင်မြင်ပါသည်။']);
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
            'user_id'=>$request->userId,
            'category_id' => $request->categoryId,
            'qty' =>$request->qty,
            'unit' => $request->unit,
            'small_package' => $request->smallPackage,
            'price' => $request->price,
            'shop_id' =>$request->shopId,
            'Date' => $request->date
        ];
    }
}
