<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
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
Route::post('/v1/login', 'App\Http\Controllers\Api\LoginControllerApi@login');


Route::middleware('auth:sanctum')->prefix('v1')->group(function () {
    Route::get('/hotels', 'App\Http\Controllers\Api\HotelController@index');
    Route::get('/hotel-details', 'App\Http\Controllers\Api\HotelController@details');
    Route::get('/facilities', 'App\Http\Controllers\Api\HotelController@facilities');
    Route::get('/category', 'App\Http\Controllers\Api\HotelController@category');
    Route::get('/location', 'App\Http\Controllers\Api\HotelController@location');
    Route::get('/details', 'App\Http\Controllers\Api\HotelController@hotelDetails');
    Route::get('/roomlists', 'App\Http\Controllers\Api\HotelController@roomLists');

    Route::post('/create-tour', 'App\Http\Controllers\Api\TourController@createTour');
    Route::get('/hotels/{hotelId}/facilities', [App\Http\Controllers\RoomtypeController::class, 'getHotelFacilities']);
    Route::post('/logout', 'App\Http\Controllers\Api\LoginControllerApi@logout');

    Route::get('/cities', function (Request $request) {
        $input = $request->query('input');
        
        $response = Http::get("https://maps.googleapis.com/maps/api/place/autocomplete/json", [
            'input' => $input,
            'key' => "AIzaSyCLzISM9kkNCKKmQs7BcpSll4emFw1yicw",
            'types' => '(cities)',
        ]);

        return $response->json();
    });
});