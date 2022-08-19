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

    Route::resource('projects', ProjectController::class);
    Route::get('getProjectList','ProjectController@get_project_list')->name('getProjectList');

});