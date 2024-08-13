<?php

use App\Http\Controllers\CarsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HistoryController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return redirect()->route("index");
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('index', [HomeController::class, 'index'])->name('index');
Route::get('history', [HomeController::class, 'history'])->name('history');
Route::get('data', [HomeController::class, 'data'])->name('data');
Route::resource('cars', CarsController::class)->names('cars');
Route::resource('data_history', HistoryController::class)->names('data_history');
Route::post('/car-check', [CarsController::class, 'check'])->name('car.check');
Route::post('/car-check-card', [CarsController::class, 'card'])->name('car.check.card');
Route::post('/car-update-card', [CarsController::class, 'card_update'])->name('car.update.card');
