<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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

Route::get('/', [AdminController::class, 'index'])->name('login');
Route::post('/login', [AdminController::class, 'login'])->name('login-admin');

Route::middleware('auth:admin')->group(function () {
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');
    Route::get('/order', [OrderController::class, 'index'])->name('order');
    Route::get('/courier/create', [CourierController::class, 'create'])->name('courier.create');
    Route::post('/courier/', [CourierController::class, 'store'])->name('courier.store');
    Route::get('/courier', [CourierController::class, 'index'])->name('courier.index');
    Route::get('/courier/{courier}', [CourierController::class, 'show'])->name('courier.show');

    Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/company/', [CompanyController::class, 'store'])->name('company.store');
});
