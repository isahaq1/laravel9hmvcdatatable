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
    Route::resource('fieldstaff', FieldstaffController::class);
    Route::get('getFieldstaffList','FieldstaffController@get_fieldstaff')->name('getFieldstaffList');
    Route::post('changeUserStatus/{id}','FieldstaffController@changeUserStatus')->name('changeUserStatus');

    Route::resource('staff-report', UserReportController::class);
    Route::get('getUserOutlets','UserReportController@getUserOutlet')->name('getUserOutlets');
});


