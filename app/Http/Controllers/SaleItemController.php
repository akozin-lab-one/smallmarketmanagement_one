<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Products;
use App\Models\SaleItem;
use App\Models\SaleList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SaleItemController extends Controller
{

    //listPage
    public function listPage(){
        $Products = Products::select('id','name')->get();
        $saleProducts = SaleItem::get();

        $itemList = SaleList::select('name',DB::raw('SUM(total_cost) as total'))
                    ->where('user_id', Auth::user()->id)
                    ->whereDate('created_at', Carbon::today()->toDateString())
                    ->groupBy('name')
                    ->get();

        return view('adminuser.Sale.saleList', compact('Products','saleProducts', 'itemList'));
    }
}
