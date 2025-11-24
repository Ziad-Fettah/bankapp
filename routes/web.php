<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\StatsController;
use App\Http\Middleware\AdminAuth;

// Admin login routes (excluded from middleware)
Route::get('/admin/login', [\App\Http\Controllers\AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [\App\Http\Controllers\AdminController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [\App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');

// Redirect root to admin login
Route::get('/', function () {
    return redirect()->route('admin.login');
});

// All other routes protected by AdminAuth middleware
Route::middleware(AdminAuth::class)->group(function () {

    // Home page
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    // Clients
    Route::resource('clients', ClientController::class);
    Route::get('/clients/{id}', [ClientController::class, 'show'])->name('clients.show');

    // Accounts
    Route::get('/accounts/logs', [AccountController::class, 'logs'])->name('accounts.logs');
    Route::get('/accounts/{id}/freeze', [AccountController::class, 'freeze'])->name('accounts.freeze');
    Route::get('/accounts/{id}/unfreeze', [AccountController::class, 'unfreeze'])->name('accounts.unfreeze');
    Route::resource('accounts', AccountController::class);

    // Transfers
    Route::resource('transfers', TransferController::class);

    // Stats
    Route::get('/stats', [AccountController::class, 'stats'])->name('stats.index');
    Route::get('/stats', [StatsController::class, 'stats'])->name('stats.index');
});
