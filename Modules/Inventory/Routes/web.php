<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['XssSanitization','auth'])->group(function() {

    Route::resource('inventory-dashboard', InventoryController::class);
    Route::resource('product-recive', ProductReciveController::class);

    Route::get('get-product-list','ProductReciveController@getProductByClient')->name('get-product-list');
    Route::get('get-receive-list','ProductReciveController@getReceiveList')->name('get-receive-list');
    Route::get('approve-receive','ProductReciveController@approveReceive')->name('approve-receive');


    Route::resource('checkouts', CheckoutController::class);
    Route::get('getUserProductList','CheckoutController@getUserProductList')->name('getUserProductList');
    Route::get('get-checkout-list','CheckoutController@getCheckoutList')->name('get-checkout-list');

    Route::resource('stock-report', StockReportController::class);
    Route::get('getStockList','StockReportController@getStockList')->name('getStockList');



});

