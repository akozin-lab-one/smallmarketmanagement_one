<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiResourceController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//getlist
Route::get('product/list/', [ApiResourceController::class, 'ProductList']);
Route::get('category/list/', [ApiResourceController::class, 'CategoryList']);
Route::get('shop/list/', [ApiResourceController::class, 'ShopList']);
Route::get('saleproduct/list/', [ApiResourceController::class, 'SaleProductList']);
Route::get('price/list/', [ApiResourceController::class, 'PriceList']);

//postlist
Route::post('create/product', [ApiResourceController::class, 'CreateProduct']);
Route::post('create/shop', [ApiResourceController::class, 'CreateShop']);
Route::post('create/category', [ApiResourceController::class, 'CreateCategory']);
