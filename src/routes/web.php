<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [LoginController::class, 'login'])->name('login');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/', [LoginController::class, 'handle'])->name('handle');

Route::get('/booking', [BookingController::class, 'booking']);

Route::get('/booking-overview', [BookingController::class, 'booking']);
