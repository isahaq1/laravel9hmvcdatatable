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


Route::middleware(['XssSanitization','auth'])->group(function () {
    Route::resource('products', ProductController::class);
    Route::get('productListAjax','ProductController@get_ajaxdata')->name('productListAjax');
    
    Route::resource('product-category', ProductCategoryController::class);
    Route::resource('product-brand', ProductBrandController::class);
    Route::resource('posms-item', PosmsController::class);
    Route::resource('product-assign', ProductAssignController::class);

    Route::get('assignProducList','ProductAssignController@get_ajaxdata')->name('assignProducList');
    Route::get('getProductList','ProductAssignController@productlist')->name('getProductList');

});

