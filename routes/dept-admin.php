<?php

use App\Http\Controllers\Department\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Department\DashboardController;

Route::prefix('dept-admin')->name('dept-admin.')->group(function () {

    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login'])->name('login');
    // Auth
    Route::middleware('auth:dept_admin')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });
});