<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AdminPairsController;
use App\Http\Controllers\API\AdminCurrencyController;
use App\Http\Controllers\API\AdminConvertsController;
use App\Http\Controllers\RegisterController;


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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::post('logout', [
        RegisterController::class, 'logout'
    ]);
});

// Route::apiResource("users", AdminUserController::class);
Route::controller(RegisterController::class)->group(function(){
    Route::post('login', 'login');
    // Route::get('logout', 'logout');
});


Route::apiResource("currencies", AdminCurrencyController::class)->except(['create','edit','delete']);
Route::apiResource("pairs", AdminPairsController::class)->except(['create','edit','delete']);
Route::apiResource("converts", AdminConvertsController::class)->except(['create','edit']);
