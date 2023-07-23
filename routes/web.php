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
            Route::get('/{hotel}', [\App\Http\Controllers\HotelController::class, 'edit'])->name(
                'hotels.edit'
            );
            Route::patch('/{hotel}', [\App\Http\Controllers\HotelController::class, 'update'])->name(
                'hotels.update'
            );
            Route::delete('/{hotel}', [\App\Http\Controllers\HotelController::class, 'delete'])->name(
                'hotels.delete'
            );
        });
    });

    Route::get('/bookings', [\App\Http\Controllers\BookingController::class, 'index'])->name('bookings.index');
    Route::post('/bookings', [\App\Http\Controllers\BookingController::class, 'store'])->name('bookings.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
