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

Route::prefix('location')->middleware(['XssSanitization','auth'])->group(function() {
    Route::get('', 'LocationController@index');
    Route::post('/store-country', 'LocationController@storeCountry')->name('store-country');
    Route::post('/store-region', 'LocationController@storeRegion')->name('store-region');
    Route::post('/delete-region/{id}', 'LocationController@delteRegion')->name('delete-region');
    Route::post('/store-location', 'LocationController@storeLocation')->name('store-location');
    Route::post('/delete-location/{id}', 'LocationController@delteLocation')->name('delete-location');
});

Route::resource('group-location', GroupLocationController::class)->middleware(['XssSanitization','auth']);

