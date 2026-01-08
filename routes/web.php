<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PlaystationController;
use App\Http\Controllers\TransactionController;

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

Route::get('/', [HomeController::class, 'index'])->middleware('role:admin')->name('home');
Route::get('/setting', [SettingController::class, 'index'])->middleware('role:admin')->name('setting');
Route::resource('playstation', PlaystationController::class);
Route::resource('zone', ZoneController::class);
Route::resource('food', FoodController::class);
Route::post('/transaction/store', [TransactionController::class, 'store'])->middleware('role:admin')->name('transaction.store');
Route::put('/transaction/update', [TransactionController::class, 'update'])->middleware('role:admin')->name('transaction.update');
Route::put('/transaction/{id}/finished', [TransactionController::class, 'finished'])->middleware('role:admin')->name('transaction.finished');
Route::delete('/transaction/{id}/cancelled', [TransactionController::class, 'cancelled'])->middleware('role:admin')->name('transaction.cancelled');
Route::post('/transaction/food', [TransactionController::class, 'food'])->middleware('role:admin')->name('transaction.food');
Route::get('/order', [OrderController::class, 'index'])->middleware('role:admin')->name('order');
Route::get('/riwayat', [RiwayatController::class, 'index'])->middleware('role:admin')->name('riwayat');

// AUTHENTICATION
// ====================================================================
Route::get('/login', [AuthController::class, 'loginForm']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// ====================================================================
