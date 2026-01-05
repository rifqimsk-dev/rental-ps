<?php

use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PlaystationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ZoneController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/setting', [SettingController::class, 'index'])->name('setting');
Route::resource('playstation', PlaystationController::class);
Route::resource('zone', ZoneController::class);
Route::resource('food', FoodController::class);
Route::post('/transaction/store', [TransactionController::class, 'store'])->name('transaction.store');
Route::put('/transaction/update', [TransactionController::class, 'update'])->name('transaction.update');
Route::put('/transaction/{id}/finished', [TransactionController::class, 'finished'])->name('transaction.finished');
Route::delete('/transaction/{id}/cancelled', [TransactionController::class, 'cancelled'])->name('transaction.cancelled');
Route::get('/order', [OrderController::class, 'index'])->name('order');
