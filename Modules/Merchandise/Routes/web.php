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
    Route::resource('merchandise-dashboard', MerchandiseController::class);

    Route::resource('ready-stock', ReadyStockController::class);
    Route::get('getOutletReadyStock', 'ReadyStockController@getOutletReadyStock')->name('getOutletReadyStock');
    Route::resource('oos', OosController::class);
    Route::get('getClientOos', 'OosController@getClientOos')->name('getClientOos');
});



