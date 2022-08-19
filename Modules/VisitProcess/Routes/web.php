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
    Route::resource('visit-dashboard', VisitProcessController::class);

    Route::resource('schedules', ScheduleController::class);
    Route::get('getRoutePlanLocation','ScheduleController@getRoutePlanLocation')->name('getRoutePlanLocation');
    Route::get('getRouteWaisOutlet','ScheduleController@getRouteWaisOutlet')->name('getRouteWaisOutlet');
    Route::get('getScheduleList','ScheduleController@get_schedule_list')->name('getScheduleList');


    Route::resource('route-plane', RoutePlaneController::class);
    Route::get('getLocationList','RoutePlaneController@getLocation')->name('getLocationList');
    Route::get('routePlaneList','RoutePlaneController@get_route_plane')->name('routePlaneList');

    Route::resource('exception-visit', ExceptionController::class);

    Route::resource('visited-images', ImagesController::class);
    Route::get('getVisitedImages','ImagesController@getVisitedImage')->name('getVisitedImages');


});
