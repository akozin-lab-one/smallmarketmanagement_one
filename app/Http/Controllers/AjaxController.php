<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Daily;
use App\Models\monthly;
use App\Models\Products;
use App\Models\SaleItem;
use App\Models\SaleList;
use App\Models\RemainItem;
use Illuminate\Http\Request;
use App\Models\SaleProductlist;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    //list Page
    function listSearchPage(Request $request){
        $data = "";

        $products = SaleProductlist::select('sale_productlists.id', 'sale_productlists.name', 'sale_prices.sale_price')
                ->leftjoin('sale_prices', 'sale_productlists.id', 'sale_prices.product_id')
                ->where('name', 'like', '%'.$request->searchValue.'%')
                ->get()
                ->groupBy('name');
        // logger($products);
        return $products;
    }

    //add Page
    function AddDataList(Request $request){
        // logger($request);
        // $productId = $request->productId;
        $userId = $request->userId;
        $productName = $request->productName;
        $productQty = $request->productQty;
        $productUnit = $request->productunit;
        $salePrice = $request->salePrice;
        $totalCost = $salePrice * $productQty;
        // logger($totalCost);

        $saleData = [
            // 'productId' => $productId,
            'user_id'=> $userId,
            'name' => $productName,
            'price' => $salePrice,
            'qty' => $productQty,
            'unit' => $productUnit,
            'total_cost' => $totalCost
        ];

        SaleItem::create($saleData);

        $getData = SaleItem::orderBy('id', 'desc')->get();
        // logger($getData);
        return $getData;
    }

    //add sale List
    function AddSaleList(Request $request){
        // logger($request->all());

        foreach ($request->all() as $item) {
            SaleItem::where('user_id', $item['userId'])->delete();

            $total = 0;
            $data = SaleList::create([
                'user_id' => $item['userId'],
                'name' => $item['saleName'],
                'qty' => $item['saleQty'],
                'unit' => $item['saleUnit'],
                'price' => $item['salePrice'],
                'total_cost' => $item['saleTotalCost']
            ]);
            $total += $data->total_cost;

            $mainQty = SaleProductlist::select('sale_productlists.name', 'sale_productlists.qty', 'sale_productlists.Date', 'categories.name as category_name', 'shops.name as shop_name')
                                    ->leftjoin('categories', 'sale_productlists.category_id', 'categories.id')
                                    ->leftjoin('shops', 'sale_productlists.shop_id', 'shops.id')
                                    ->where('sale_productlists.name', $data->name)
                                    ->first();

            logger($mainQty->shop_name);
            $remainQty = $mainQty->qty - intval($data->qty);
            logger($remainQty);
            $updateData = [
                'qty' => $remainQty
            ];
            $update = SaleProductlist::where('sale_productlists.name', $data->name)->update($updateData);
            RemainItem::create([
                'product_name' => $mainQty->name,
                'category_name' => $mainQty->category_name,
                'qty' => $remainQty,
                'shop_name' => $mainQty->shop_name,
                'date' => $mainQty->Date
            ]);

        };

        return $request->all();


    }

    //add daily
    public function AddDailySale(Request $request){

        $date = Carbon::today()->toDateString();
        Daily::create([
            'date' => $date,
            'item_list' => $request->itemList,
            'daily_total' => $request->dailyTotal
        ]);

    }

    //add daily sale
    public function AddDaily(Request $request){
        $monthlyInc = SaleList::select('name', DB::raw('count(name) as count_name'), DB::raw('SUM(total_cost) as total'))
                        ->whereMonth('created_at', Carbon::now()->month)
                        ->groupBy('name')
                        ->get();

        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'July', 'Aug', 'sep', 'Oct', 'Nov', 'Dec' ];
        $monthNum = Carbon::now()->month - 1;
        $monthName = $months[$monthNum];

        $most = $monthlyInc->max('count_name');
        $totalCost = $monthlyInc->sum('total');

        monthly::create([
            'month' => $monthName,
            'most_sale_item' => $most,
            'total' => $totalCost
        ]);
    }
    //addTable List
    // function addTableList(){
    //     $saleProduct = SaleItem::get();
    //     dd($saleProduct);
    // }
}
