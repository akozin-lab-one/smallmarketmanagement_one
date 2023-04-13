<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\SaleItem;
use Illuminate\Http\Request;

class SaleItemController extends Controller
{

    //listPage
    public function listPage(){
        $Products = Products::select('id','name')->get();
        $saleProducts = SaleItem::get();
        // dd($saleProducts->toArray());
        // dd($Products->toArray());
        return view('adminuser.Sale.saleList', compact('Products', 'saleProducts'));
    }
}
