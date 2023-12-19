<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    //shop List Page
    public function shopListPage(){
        $shopList = Shop::where('user_id', Auth::user()->id)->first();
        $total_cost = Products::select(DB::raw('SUM(price) as total_price'))
                    ->where('user_id', Auth::user()->id)
                    ->groupBy('category_id')
                    ->get();
        // dd($total_cost->toArray());
        return view('adminuser.Shop.shop', compact('shopList', 'total_cost'));
    }

    //shop createPage
    public function createPage(){
        return view('adminuser.Shop.create');
    }

    //create
    public function create(Request $request){
        // dd($request->toArray());
        $this->requestValidationData($request);
        $data = $this->requestShopData($request);

        Shop::create($data);
        return back()->with(['createShopsuccess'=>' ဆိုင်လိပ်စာ ထည့်သွင်းပြီးပါပြီ။ အသေးစိတ်ကြည့်လိုပါက မူလ Page သို့သွားပေးပါ။']);
    }

    //detail
    public function DetailShop($id){
        $shopDetail = Shop::where('id', $id)->first();
        return view('adminuser.Shop.detail', compact('shopDetail'));
    }

    //update
    public function editPage($id){
        $shopList = Shop::where('id', $id)->first();
        return view('adminuser.Shop.edit', compact('shopList'));
    }

    //updateData
    public function editData(Request $request){
        $this->requestValidationData($request);
        $data = $this->requestShopData($request);
        Shop::where('id', $request->ShopId)->update($data);
        return redirect()->route('adminuser#shoplist');
    }

    //delete
    public function deleteData($id){
        Shop::where('id', $id)->delete();
        return back()->with(['deleteShopsuccess'=> 'သင်၀ယ်ယူနေသည့် ဆိုင်လိပ်စာကို ပယ်ဖျက်ပြီးပါပြီ။']);
    }

    //request validation data
    private function requestValidationData($request){
        $validateRule = [
            'name' => 'required',
            'phoneNumber' => 'required|min:11',
            'address' => 'required|min:10'
        ];
        Validator::make($request->all(), $validateRule)->validate();
    }

    // request data
    private function requestShopData($request){
        return[
            'name' => $request->name,
            'user_id'=>$request->userId,
            'phone_number' => $request->phoneNumber,
            'address' => $request->address
        ];
    }
}

