<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\DownSyncApi;
use App\Http\Controllers\Api\OutletController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Auth\JwtAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return sendSuccessResponse('Please Login first','',200);
});


// Route::middleware(['XssSanitization','auth:jwt_auth'])->group(function() {
//     Route::resource('/', ApiController::class);
//     Route::resource('outlets',OutletController::class);
// });


Route::controller(DownSyncApi::class)->group(function () {

    Route::middleware('auth:jwt_auth')->group(function () {
        Route::get('down-sync', 'DownSyncData');
    });
    
});


Route::controller(UserApiController::class)->group(function () {
    Route::middleware(['auth:jwt_auth'])->group(function () {
        Route::post('update-profile', 'updateProfile');
    });
});


Route::controller(ApiController::class)->group(function () {
    Route::middleware(['XssSanitization'])->group(function () {
        Route::get('countries', 'getCountryList');
        Route::post('state', 'getStateList');
        Route::post('lga', 'getLgaList');
        Route::get('bank', 'getBankList');
        Route::get('education', 'getEducationList');
        Route::get('guarantor_type_id', 'getGuarantor');
    });
});


Route::controller(JwtAuthController::class)->group(function () {
    
    Route::post('login', 'login');
    Route::post('create-user', 'register');

    Route::middleware('auth:jwt_auth')->group(function () {
        Route::post('logout', 'logout');
        Route::get('profile', 'me');
        Route::get('refresh', 'refresh');
    });
    
});






