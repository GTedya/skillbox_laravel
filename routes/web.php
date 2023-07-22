<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::prefix('/hotels')->group(function () {
        Route::get('/', [\App\Http\Controllers\HotelController::class, 'index'])->name('hotels.index');
        Route::get('/hotels/{hotel}', [\App\Http\Controllers\HotelController::class, 'show'])->name('hotels.show');

        Route::middleware('admin')->group(function () {
            Route::get('/create', [\App\Http\Controllers\HotelController::class, 'create'])->name(
                'hotels.create'
            );
            Route::post('/store', [\App\Http\Controllers\HotelController::class, 'store'])->name(
                'hotels.store'
            );
            Route::prefix('/{hotel}',)->group(function () {
                Route::get('/', [\App\Http\Controllers\HotelController::class, 'edit'])->name(
                    'hotels.edit'
                );
                Route::patch('/', [\App\Http\Controllers\HotelController::class, 'update'])->name(
                    'hotels.update'
                );
                Route::delete('/', [\App\Http\Controllers\HotelController::class, 'delete'])->name(
                    'hotels.delete'
                );
                Route::prefix('rooms',)->group(function () {
                    Route::get('create', [\App\Http\Controllers\RoomController::class, 'create'])->name('rooms.create');
                    Route::get('edit/{room}', [\App\Http\Controllers\RoomController::class, 'edit'])->name('rooms.edit');
                    Route::post('store', [\App\Http\Controllers\RoomController::class, 'store'])->name('rooms.store');
                    Route::delete('/{room}', [\App\Http\Controllers\RoomController::class, 'delete'])->name('rooms.delete');
                    Route::patch('/{room}', [\App\Http\Controllers\RoomController::class, 'update'])->name('rooms.update');
                });
            });
        });
    });


    Route::get('/bookings', [\App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
    Route::get('/bookings/{booking}', [\App\Http\Controllers\BookingController::class, 'show'])->name('bookings.show');
    Route::get('/bookings/edit/{booking}', [\App\Http\Controllers\BookingController::class, 'edit'])->name('bookings.edit');
    Route::delete('/bookings/{booking}', [\App\Http\Controllers\BookingController::class, 'delete'])->name('bookings.delete');
    Route::post('/bookings', [\App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
    Route::patch('/bookings/{booking}', [\App\Http\Controllers\BookingController::class, 'update'])->name('bookings.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
