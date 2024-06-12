<?php

use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\OrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourierController;

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
    Route::post('login', [CourierController::class, 'login']);
    Route::middleware(['force.json', 'auth:sanctum'])->group(function () {
        Route::post('logout', [CourierController::class, 'logout']);
        Route::get('orders', [OrderController::class, 'index']);
        Route::post('orders/{order}/accept', [OrderController::class, 'acceptPackage']);
        Route::put('orders/{order}/pickup', [OrderController::class, 'pickupPackage']);
        Route::put('orders/{order}/deliver', [OrderController::class, 'deliverPackage']);
        Route::post('couriers/{courier}/live-location', [CourierController::class, 'sendLiveLocation']);
        Route::get('couriers/{courier}/live-location', [CourierController::class, 'getLiveLocation']);

    });
//    for routes using Api Key
    Route::middleware(['check.api.key'])->group(function () {
        Route::post('orders', [OrderController::class, 'submitDelivery']);
        Route::get('orders/company', [CompanyController::class, 'index']);
        Route::get('orders/company/{order}', [CompanyController::class, 'show']);
        Route::delete('orders/{order}', [OrderController::class, 'cancelOrder']);
    });
});

