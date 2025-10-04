<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;

Route::get('/', [FrontController::class, 'home'])->name('services.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route::resource('/service_transactions', ServiceController::class)->middleware('role:owner|buyer');



    // daftar antrian
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index')->middleware('role:owner|buyer');

    Route::get('/services/create', [ServiceController::class, 'create'])->name('services.create')->middleware('role:owner|buyer');
    Route::post('/services', [ServiceController::class, 'store'])->name('services.store')->middleware('role:owner|buyer');

    // detail service (pakai binding model)
    Route::get('/services/{service}', [ServiceController::class, 'show'])->name('services.show')->middleware('role:owner|buyer');

    // update status (approve / reject / done)
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update')->middleware('role:owner');

    Route::put('/services/{service}/update-cost', [ServiceController::class, 'updateCost'])
        ->name('services.update_cost')
        ->middleware('role:owner'); // hanya owner yang bisa akses

    Route::post('/services/{service}/upload-nota', [ServiceController::class, 'uploadNota'])->name('services.uploadNota');
});

require __DIR__ . '/auth.php';
