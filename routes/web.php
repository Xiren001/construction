<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\WorkloadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Contracts\Routing\Registrar as MiddlewareRegistrar;
use App\Http\Middleware\CheckUserType;
use App\Http\Controllers\EmployeeImageController;

// Public Routes
Route::get('/', [UserController::class, 'landingpage'])->name('landingpage');

Route::middleware([
    'web',
    'verified',
    CheckUserType::class, // Register the middleware here
])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware('verified')->name('dashboard');
    Route::get('/dashboard', [EmployeeController::class, 'showDashboard'])->middleware('verified')->name('dashboard');
    Route::get('/dashboard', [ClientController::class, 'showDashboard'])->middleware('verified')->name('dashboard');
    Route::get('/dashboard', [WorkloadController::class, 'showDashboard'])->middleware('verified')->name('dashboard');
});

// Authenticated Routes
Route::middleware(['auth'])->group(function () {

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Workload Routes
    Route::prefix('workload')->group(function () {
        Route::get('/', [WorkloadController::class, 'index'])->name('workload.index');
        Route::post('/', [WorkloadController::class, 'store'])->name('workload.store');
        Route::patch('/{id}/status', [WorkloadController::class, 'updateStatus'])->name('workload.updateStatus');
        Route::post('/checklist', [WorkloadController::class, 'submitChecklist'])->name('workload.submitChecklist');
        Route::get('/completed', [WorkloadController::class, 'indexCompletedWorks'])->name('completed_works.index');
        Route::get('/completed/{id}', [WorkloadController::class, 'showCompletedWork'])->name('completed_works.show');
        Route::get('/workloadlist/view', [WorkloadController::class, 'showReadOnly'])->name('workload.readOnly');
        Route::get('/workload/read-onlyy', [WorkloadController::class, 'showReadOnlyy'])->name('workload.read-onlyy');
    });

    // Employee Routes
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');

    // Client Routes
    Route::resource('clients', ClientController::class);
    Route::get('/clients', [ClientController::class, 'index'])->name('client.index');
    Route::post('/clients', [ClientController::class, 'store'])->name('client.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('client.destroy');
    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');

    // Service Routes
    Route::resource('services', ServiceController::class);
    Route::get('/services', [ServiceController::class, 'index'])->name('service.index');
    Route::post('/services', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/services/{service}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/services/{service}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('service.destroy');
});

// Authentication Routes
require __DIR__ . '/auth.php';
