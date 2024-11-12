<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\ReservationController;


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

Route::get('/', function () {
    return redirect()->route('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Client routes
Route::middleware('auth')->group(function () {
    Route::get('/home', [ReservationController::class, 'index'])->name('home');
    Route::resource('reservations', ReservationController::class)->only(['index', 'create', 'store']);
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('rooms', RoomController::class)->except(['show']);
    Route::resource('reservations', AdminReservationController::class)->only(['index', 'edit', 'update', 'destroy']);
});
