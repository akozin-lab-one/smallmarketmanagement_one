<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\SuperController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SaleItemController;
use App\Http\Controllers\RemainItemController;
use App\Http\Controllers\ResetpasswordController;

Route::middleware(['adminAuth'])->group(function(){
    Route::redirect('', 'loginpage');

    Route::get('/loginpage', [AuthController::class, 'loginPage'])->name('Auth#login');

    Route::get('/registerpage', [AuthController::class, 'registerPage'])->name('Auth#register');
});

Route::middleware([ 'auth',
                    'verified'])->group(function () {
    Route::get('dashboard', [Authcontroller::class, 'dashboard'])->name('dashboard');

    //superuser
    Route::middleware(['superAuth'])->group(function(){
        Route::prefix('superuser')->group(function(){
            Route::prefix('dashboard')->group(function(){
                Route::get('/main', [SuperController::class, 'dashboardPage'])->name('Super#dashboard');

                Route::get('/detail/{id}', [SuperController::class, 'detailPage'])->name('Super#detail');

                Route::get('/editpage/{id}', [SuperController::class, 'editPage'])->name('Super#editPage');

                Route::post('/edit', [SuperController::class, 'editData'])->name('Super#edit');

                Route::get('/team', [SuperController::class, 'teamPage'])->name('Super#team');
            });

            Route::group(['prefix'=>'ajax'], function(){
                //getuesrStatus
                Route::get('/userStatus', [AjaxController::class, 'getUserStatus'])->name('user#Status');

                //getuserDuration
                Route::get('/userDuration', [AjaxController::class, 'getUserDuration'])->name('ajax#userduration');
            });
        });
    });

    //adminuser
    Route::group(['middleware'=>'adminAuth', 'middleware' => 'expired_checked'],function(){
        Route::prefix('adminuser')->group(function(){
                Route::get('/main', [ProductsController::class, 'mainPage'])->name('adminuser#main');

                Route::get('/mainabout', [ProductsController::class, 'mainAboutPage'])->name('adminuser#about');

                Route::prefix('shop')->group(function(){
                    Route::get('/', [ShopController::class, 'shopListPage'])->name('adminuser#shoplist');

                    //view
                    Route::get('/detail/{id}', [ShopController::class, 'DetailShop'])->name('adminuser#shopdetail');

                    //create
                    Route::get('/createPage', [ShopController::class, 'createPage'])->name('adminuser#createPage');
                    Route::post('create', [ShopController::class, 'create'])->name('adminuser#create');

                    //delete
                    Route::get('delete/{id}', [ShopController::class, 'deleteData'])->name('adminuser#delete');

                    //editPage
                    Route::get('edit/{id}', [ShopController::class, 'editPage'])->name('adminuser#editPage');
                    Route::post('edit', [ShopController::class, 'editData'])->name('adminuser#edit');
                });

                //category
                Route::group(['prefix' => 'category'], function(){
                    //main
                    Route::get('', [CategoryController::class, 'mainPage'])->name('adminuser#categorymain');

                    //create
                    Route::get('/createPage', [CategoryController::class, 'createPage'])->name('adminuser#categorycreate');

                    //createdata
                    Route::post('/create', [CategoryController::class, 'createCategory'])->name('adminuser#categorycreatedata');

                    //delete
                    Route::get('delete/{id}', [CategoryController::class, 'deleteData'])->name('adminuser#categorydelete');

                    //editPage
                    Route::get('edit/{id}', [CategoryController::class, 'editPage'])->name('adminuser#categoryeditPage');

                    //edit
                    Route::post('/edit', [CategoryController::class, 'editData'])->name('adminuser#editcategory');
                });

                //cargo
                Route::prefix('cargo')->group(function(){
                    Route::get('/', [ProductsController::class, 'cargoMainPage'])->name('product#mainpage');

                    //create page
                    Route::get('/createPage', [ProductsController::class, 'createMainPage'])->name('product#createmain');

                    //create
                    Route::post('/create', [ProductsController::class, 'createData'])->name('product#create');

                    //delete
                    Route::get('/delete/{id}', [ProductsController::class, 'deleteData'])->name('product#delete');

                    //editPage
                    Route::get('edit/{id}', [ProductsController::class, 'editPage'])->name('product#editPage');

                    //edit
                    Route::post('edit/', [ProductsController::class, 'editData'])->name('product#editdata');

                });

                //remaining cargo
                Route::group(['prefix'=>'remain'], function(){
                    Route::get('main', [RemainItemController::class, 'RemainListPage'])->name('remain#main');
                });

                //price
                Route::group(['prefix'=> 'price'], function(){

                    //main page
                    Route::get('main', [PriceController::class, 'mainPage'])->name('price#mainpage');

                    //detail page
                    Route::get('detail/{id}', [PriceController::class, 'detailPage'])->name('price#detailPage');

                    //create sale price
                    Route::get('createPage', [PriceController::class, 'createPage'])->name('price#createPage');

                    //createdata
                    Route::post('create', [PriceController::class, 'createData'])->name('price#createdata');
                });

                //sale
                Route::prefix('sale')->group(function(){
                    Route::get('/', [SaleItemController::class, 'ListPage'])->name('adminuser#list');
                });

                //account
                Route::group(['prefix'=>'account'], function(){
                    //main account
                    Route::get('/{id}', [AccountController::class, 'accountMainPage'])->name('account#main');

                    //edit account
                    Route::get('/edit/{id}', [AccountController::class, 'accountEditPage'])->name('account#editPage');

                    //edit
                    Route::post('/editdata', [AccountController::class, 'EditData'])->name('edit#account');

                    //setting
                    Route::get('/setting/{id}', [AccountController::class, 'SettingPage'])->name('setting#account');

                    //password change
                    Route::post('change/password', [AccountController::class, 'ChangePassword'])->name('change#password');

                    //reset password
                    Route::get('forget-password/{id}', [ResetpasswordController::class, 'ForgetPasswordPage'])->name('password.request');

                    //password reset
                    Route::post('forget-password/', [ResetpasswordController::class, 'PasswordForget'])->name('password.email');

                    // // passwrod_get
                    Route::get('reset-password/{token}', [ResetPasswordController::class, 'resetPasswordGetPage'])->name('reset.password.get');

                    //submit reset password form
                    Route::post('reset-password', [ResetPasswordController::class, 'submitPasswordForm'])->name('reset.password.post');
                });

                //ajax
                Route::group(['prefix'=>'ajax'], function(){
                    //list
                    Route::get('/list', [AjaxController::class, 'ListSearchPage'])->name('ajax#search');

                    //add list
                    Route::get('/add', [AjaxController::class, 'AddDataList'])->name('ajax#add');

                    //add saleList and delete sale item
                    Route::get('/addsalelist', [AjaxController::class, 'AddSaleList'])->name('ajax#saleList');

                    //add sale
                    Route::get('/addSale', [AjaxController::class, 'AddDailySale'])->name('ajax#daily');

                    //add daily
                    Route::get('/addDaily', [AjaxController::class, 'AddDaily'])->name('ajax#dailyadd');

                    // usercontrol
                    // Route::get('/userStatus', [AjaxController::class, 'getUserStatus'])->name('ajax#userstatus');

                    // //add tabel
                    // Route::get('addTable', [AjaxController::class, 'AddTableList'])->name('ajax#addtable');
                });

        });
    });
});

