<?php

use App\Http\Controllers\InterventionController;
use App\Http\Controllers\UserController;
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
Route::delete('/machine/delete/{id}' , [MachineController::class, 'do_delete'])->name('machine.do_delete');

// ========== Interventions ==========
Route::get('/intervention', [InterventionController::class, 'show'])->name('intervention');
Route::get('/intervention/detail/{id}', [InterventionController::class, 'detail'])->name('intervention.detail');
Route::get('/intervention/add', [InterventionController::class, 'add'])->name('intervention.add');
Route::post('/intervention/add', [InterventionController::class, 'do_add'])->name('intervention.do_add');
Route::get('/intervention/update/{id}' , [InterventionController::class, 'update'])->name('intervention.update');
Route::put('intervention/update/{id}' , [InterventionController::class, 'do_update'])->name('intervention.do_update');
Route::delete('/intervention/delete/{id}', [InterventionController::class, 'do_delete'])->name('intervention.do_delete');

// ========== User ==========
Route::get('/user', [UserController::class, 'show'])->name('user');
Route::get('/user/detail/{id}', [UserController::class, 'detail'])->name('user.detail');
Route::get('/user/add', [UserController::class, 'add'])->name('user.add');
Route::post('/user/add', [UserController::class, 'do_add'])->name('user.do_add');
Route::get('/user/update/{id}' , [UserController::class, 'update'])->name('user.update');
Route::put('/user/update/{id}' , [UserController::class, 'do_update'])->name('user.do_update');
Route::delete('/user/delete/{id}', [UserController::class, 'do_delete'])->name('user.do_delete');

// ========== Error 404 : doit être la dernière route ==========
Route::fallback(function () {
    return view('error.404');
});
