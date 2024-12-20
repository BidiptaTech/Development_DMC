<?php

use App\Http\Controllers\HotelController;
use App\Http\Controllers\RoomtypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::get('/hotels', 'App\Http\Controllers\Api\HotelController@index');
    Route::get('/hotel-details', 'App\Http\Controllers\Api\HotelController@details');
    Route::get('/facilities', 'App\Http\Controllers\Api\HotelController@facilities');
    Route::get('/category', 'App\Http\Controllers\Api\HotelController@category');
    Route::get('/location', 'App\Http\Controllers\Api\HotelController@location');
    Route::get('/details', 'App\Http\Controllers\Api\HotelController@hotelDetails');
    Route::get('/hotels/{hotelId}/facilities', [RoomtypeController::class, 'getHotelFacilities']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
