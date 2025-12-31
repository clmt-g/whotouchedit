<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\MachineController;

// ========== Home ==========
Route::get('/', [DefaultController::class, 'index'])->name('dashboard');

// ========== Machine ==========
Route::get('/machine', [MachineController::class, 'show'])->name('machine');
Route::get('/machine/detail/{id}', [MachineController::class, 'detail'])->name('machine.detail');
