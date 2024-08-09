<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TripController;
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



Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('trips', TripController::class)->parameters(['trips' => 'trip:id']);
        // // route dei pagamenti
        // Route::get('/payment', [PaymentController::class, 'index'])->name('payment');
        // Route::group(['prefix' => 'payment'], function () {
        //     Route::post('/checkoutSucceeded', [PaymentController::class, 'process'])->name('payment.checkoutSucceeded');
        // });
        // route del garbage
        Route::get('/garbage', [TripController::class, 'indexDeleted'])->name('garbage');
        Route::group(['prefix' => 'garbage'], function () {
        Route::post('/{trip}/restore', [TripController::class, 'restore'])->name('garbages.restore');
        //     // Route::delete('/{apartment}/force', [ApartmentController::class, 'forceDelete'])->name('garbages.forcedelete');
        Route::post('/restore-all', [TripController::class, 'restoreAll'])->name('garbages.restoreall');
        });

    });

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
