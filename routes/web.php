<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;

// ========== Home ==========
Route::get('/', [DefaultController::class, 'index'])->name('dashboard');

// ========== Machine ==========
Route::get('/machine', [DefaultController::class, 'test']);
