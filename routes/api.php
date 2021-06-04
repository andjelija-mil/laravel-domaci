<?php

use App\Http\Controllers\APIController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//API
Route::get('/products/get',[APIController::class,'getProducts']);
Route::post('/orders/order',[APIController::class,'makeOrder']);
Route::get('/orders/check/{id}',[APIController::class,'checkOrder']);
Route::delete('/orders/cancel/{id}',[APIController::class,'cancelOrder']);
Route::get('/orders/get',[APIController::class,'getOrders']);
Route::get('/orders/total',[APIController::class,'totalOrderValue']);
