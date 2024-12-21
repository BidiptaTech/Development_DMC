<?php

use App\Http\Controllers\BedsController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\RoomtypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\MasterSettingController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FacilityController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', function () {
        return view('index');
    })->name('dashboard');

    // cache clear route    
    Route::get('/clear', function () {
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        return '<center><h1>All Cleared</h1></center>';
    });
    Route::get('/admin/dashboard', [UserController::class, 'adminlogin'])->name('admin.dashboard');
    Route::get('transaction', [UserController::class, 'transaction'])->name('transaction');
    Route::get('/admin/login-as/{userId}', [UserController::class, 'loginAsUser'])->name('admin.loginAsUser');
    //currency exchange rate
    Route::get('/exchange-rate', [CurrencyController::class, 'showExchangeRate']);

    // authentication check for admin
    Route::group(['middleware' => ['admin']], function () {
        Route::get('/features', [FeaturesController::class, 'index'])->name('features'); 
        Route::post('/save-feature-roles/{id}', [FeaturesController::class, 'saveFeatureRoles'])->name('save-feature-roles');
        Route::post('/update-status', [FeaturesController::class, 'statusUpdate']);
        Route::get('master-setting', action: [MasterSettingController::class, 'index'])->name('master-setting');
        Route::post('store-setting', [MasterSettingController::class, 'store'])->name('store-setting');
        Route::resource('category', CategoryController::class);
        Route::resource('facility', FacilityController::class);
        Route::resource('roomType', RoomtypeController::class);
        Route::resource('beds', BedsController::class);
        
        Route::get('/hotels/search', [RoomtypeController::class, 'search'])->name('hotels.search');
        Route::get('/hotels/{hotelId}/facilities', [RoomtypeController::class, 'getHotelFacilities']);
        Route::post('/roomType/toggle', [RoomTypeController::class, 'toggle'])->name('roomType.toggle');
        
        Route::resource('hotels', HotelController::class);
        Route::get('calender/{hotel}', [HotelController::class, 'calender'])->name('hotels.calender');
        Route::get('yearly/calender', [HotelController::class, 'yearlycalender'])->name('hotels.yearlycalender');

        Route::get('/hotels/{hotel}/contact', [HotelController::class, 'hotelcontacts'])->name('hotels.contact');
        Route::post('/updatecontacts', [HotelController::class, 'updatecontacts'])->name('hotels.createcontacts');
        Route::get('/hotels/{hotel}/room', [HotelController::class, 'hotelrooms'])->name('hotels.room');

        Route::get('/hotels/{hotel}/rates', [HotelController::class, 'hotelrates'])->name('hotels.rates');
        Route::post('storerates', [HotelController::class, 'storerates'])->name('storerates');
        Route::get('editrate/{id}/{hotel_id}', [HotelController::class, 'editrate'])->name('rates.edit');
        Route::post('updaterates', [HotelController::class, 'updaterates'])->name('rates.update');

        Route::get('/hotels/{hotel}/season', [HotelController::class, 'hotelseason'])->name('hotels.season');
        Route::post('storeseason', [HotelController::class, 'storeseason'])->name('storeseason');
        Route::get('editseason/{id}/{hotel_id}', [HotelController::class, 'editseason'])->name('season.edit');
        Route::post('updateseason', [HotelController::class, 'updateseason'])->name('season.update');
        
        Route::get('/editcontacts/{hotel}', [HotelController::class, 'editcontacts'])->name('contactdetails.edit');
        Route::post('storeroom', [HotelController::class, 'storeroom'])->name('storeroom');
        Route::get('editroom/{id}', [HotelController::class, 'editroom'])->name('rooms.edit');
        
        Route::post('updateroom', [HotelController::class, 'updateroom'])->name('room.update');
        Route::delete('deleteroom/{id}', [HotelController::class, 'deleteroom'])->name('rooms.destroy');
        Route::get('/editcontacts/{hotel}', [HotelController::class, 'editcontacts'])->name('contactdetails.edit');
    });

        // authentication check for manager (route can access admin & manager)
        Route::group(['middleware' => ['manager']], function () {
        Route::resource('users', UserController::class);
        Route::resource('roles', RoleController::class);  
        Route::get('/get-roles-by-user-type/{userType}', [UserController::class, 'getRolesByUserType']);
        Route::get('{routeName}/{name?}', [HomeController::class, 'pageView']);
        Route::post('add-money/{id}', [UserController::class, 'add_money'])->name('add-money');
    });

});
    
