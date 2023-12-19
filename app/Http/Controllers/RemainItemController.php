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
        // $remain = RemainItem::select('product_name','category_name', DB::raw('MIN(qty) as count_qty'), 'shop_name')
        //                 ->groupBy('product_name', 'category_name', 'shop_name')
        //                 ->get();
        // $remain = RemainItem::select(
        //     'remain_items.product_name',
        //     'remain_items.category_name',
        //     'remain_items.shop_name',
        //     DB::raw('MIN(remain_items.qty) as count_qty'),
        //     'sale_productlists.qty' // Assuming there's a column named 'qty' in the 'products' table
        // )
        //     ->leftJoin('sale_productlists', 'remain_items.product_name', '=', 'sale_productlists.name')
        //     ->groupBy('remain_items.product_name', 'remain_items.category_name', 'remain_items.shop_name','remain_items.qty', 'sale_productlists.qty')
        //     ->latest('remain_items.created_at')
        //     ->get();
        // $remain = RemainItem::select(
        //         'remain_items.product_name',
        //         'remain_items.category_name',
        //         'remain_items.shop_name',
        //         'remain_items.qty'
        //         // DB::raw('MIN(remain_items.qty) as count_qty'),
        //         // 'sale_productlists.qty' 
        //     )
        //     ->groupBy('remain_items.product_name', 'remain_items.category_name', 'remain_items.shop_name','remain_items.qty')
        //     ->get();
        $remain = RemainItem::select(
            'remain_items.product_name',
            'remain_items.category_name',
            'remain_items.shop_name',
            'remain_items.qty as count_qty',
            'sale_productlists.qty as sale_qty'
        )
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
