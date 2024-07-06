<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;
use App\Http\Controllers\db\HomeController;
use App\Http\Controllers\ProfileController;



Route::get('/', [WeatherController::class, 'index'])->name('web.index');
Route::get('/Details', [WeatherController::class, 'details'])->name('web.details');

// Route::get('/activity', [WeatherController::class, 'activity'])->name('web.activity.logs');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// dashboard routes for admin 
Route::middleware('auth')->group(function () {
Route::prefix('dashboard/v1')->group(function () {

// Home routes
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/Settings', [HomeController::class, 'settings'])->name('home.settings');
Route::post('/Settings/Update/{id}', [HomeController::class, 'update'])->name('home.settings.update');
Route::get('/Settings/Create', [HomeController::class, 'create'])->name('home.settings.create');
Route::post('/Settings/Create', [HomeController::class, 'store'])->name('home.settings.store');
Route::get('/Settings/Destroy/{id}', [HomeController::class, 'destroy'])->name('home.settings.destroy');

});
});

require __DIR__.'/auth.php';
