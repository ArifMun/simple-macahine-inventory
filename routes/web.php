<?php

use App\Models\Machine;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TypeController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/auth-process', [AuthController::class, 'login']);
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);

    Route::get('/brand-type', [BrandController::class, 'index']);
    Route::post('brand/storeAndUpdate/{id?}', [BrandController::class, 'storeAndUpdate']);
    Route::post('brand/delete/{id}', [BrandController::class, 'destroy']);

    Route::post('type/storeAndUpdate/{id?}', [TypeController::class, 'storeAndUpdate']);
    Route::post('type/delete/{id}', [TypeController::class, 'destroy']);

    Route::post('machine/storeAndUpdate/{barcode_id?}', [MachineController::class, 'storeAndUpdate']);
    Route::post('machine/delete/{barcode_id}', [MachineController::class, 'destroy']);

    Route::get('/machine', [MachineController::class, 'index']);
    Route::post('/auth-logout', [AuthController::class, 'logout']);
});
