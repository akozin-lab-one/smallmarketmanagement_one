<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\SaleList;
use App\Models\RemainItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RemainItemController extends Controller
{
    //main
    public function RemainListPage(){
        $remain = RemainItem::select('product_name','category_name', DB::raw('MIN(qty) as count_qty'), 'shop_name')
                        ->groupBy('product_name', 'category_name', 'shop_name')
                        ->get();


        // dd($remain->toArray());
        // $data = RemainItem::select(
        //                            'products.name as product_name',
        //                            'shops.name as shop_name',
        //                            'categories.name as category_name',
        //                            'remain_items.qty as remain_qty')
        //                     ->leftjoin('products', 'remain_items.product_id', 'products.id')
        //                     ->leftjoin('categories', 'remain_items.category_id', 'categories.id')
        //                     ->leftjoin('shops', 'remain_items.shop_id', 'shops.id')
        //                     ->get()
        //                     ->groupBy('product_name');/
        // dd($data->toArray());
        // dd($data->min('remain_qty'));

        return view('adminuser.Remain.main', compact('remain'));
    }
}
