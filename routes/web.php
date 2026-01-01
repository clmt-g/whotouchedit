<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\MachineController;

// ========== Home ==========
Route::get('/', [DefaultController::class, 'index'])->name('dashboard');

// ========== Machine ==========
Route::get('/machine', [MachineController::class, 'show'])->name('machine');
Route::get('/machine/detail/{id}', [MachineController::class, 'detail'])->name('machine.detail');
Route::get('/machine/add', [MachineController::class, 'add'])->name('machine.add');
Route::post('/machine/add', [MachineController::class, 'do_add'])->name('machine.do_add');
Route::get('/machine/update/{id}' , [MachineController::class, 'update'])->name('machine.update');
Route::put('/machine/update/{id}' , [MachineController::class, 'do_update'])->name('machine.do_update');
