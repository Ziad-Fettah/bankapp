<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\StatsController;

Route::get('/', function () {
    return view('home');
});

Route::resource('clients', ClientController::class);

// Custom logs route should go BEFORE the resource
Route::get('/accounts/logs', [AccountController::class, 'logs'])->name('accounts.logs');
Route::get('/accounts/{id}/freeze', [AccountController::class, 'freeze'])->name('accounts.freeze');
Route::get('/accounts/{id}/unfreeze', [AccountController::class, 'unfreeze'])->name('accounts.unfreeze');

// Resource route for accounts
Route::resource('accounts', AccountController::class);

// Transfers
Route::resource('transfers', TransferController::class);

Route::get('/stats', [AccountController::class, 'stats'])->name('stats.index');

Route::get('/stats', [StatsController::class, 'stats'])->name('stats.index');

