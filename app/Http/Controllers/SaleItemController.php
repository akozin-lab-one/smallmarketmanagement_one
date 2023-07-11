<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Products;
use App\Models\SaleItem;
use App\Models\SaleList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleItemController extends Controller
{

    //listPage
    public function listPage(){
        $Products = Products::select('id','name')->get();
        $saleProducts = SaleItem::get();

        $itemList = SaleList::select('name',DB::raw('SUM(total_cost) as total'))
                    ->whereDate('created_at', Carbon::today()->toDateString())
                    ->groupBy('name')
                    ->get();
        // dd($itemList->toArray());
        return view('adminuser.Sale.saleList', compact('Products','saleProducts', 'itemList'));
    }
}
