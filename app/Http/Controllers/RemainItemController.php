<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\SaleList;
use App\Models\RemainItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class RemainItemController extends Controller
{
    //main
    public function RemainListPage(){
        $remain = RemainItem::select(
            'remain_items.product_name',
            'remain_items.category_name',
            'remain_items.shop_name',
            'remain_items.qty as count_qty',
            'sale_productlists.qty as sale_qty'
        )
        ->where('remain_items.user_id', Auth::user()->id)
        ->leftJoin('sale_productlists', 'remain_items.product_name', '=', 'sale_productlists.name')
        ->whereIn('remain_items.id', function ($query) {
            $query->select(DB::raw('MAX(id) as id'))
                ->from('remain_items')
                ->groupBy('product_name');
        })
        ->get();


        // dd($remain->toArray());

        return view('adminuser.Remain.main', compact('remain'));
    }
}
