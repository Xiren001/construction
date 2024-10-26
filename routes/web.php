<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;

Route::get('/', function () {
    return view('landingpage');
})->name('landingpage');


Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('clients', ClientController::class);
Route::get('/clients', [ClientController::class, 'index'])->name('client.index');
Route::post('/clients', [ClientController::class, 'store'])->name('client.store');
Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('client.edit');
Route::put('/clients/{client}', [ClientController::class, 'update'])->name('client.update');
Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('client.destroy');
Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');


Route::resource('services', ServiceController::class);
Route::get('/services', [ServiceController::class, 'index'])->name('service.index');
Route::post('/services', [ServiceController::class, 'store'])->name('service.store');
Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('service.edit');
Route::put('/services/{service}', [ServiceController::class, 'update'])->name('service.update');
Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('service.destroy');


Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
