<?php

use App\Http\Controllers\AnalytiqueController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\InterventionPlanifieeController;
use App\Http\Controllers\PlanningController;
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
Route::get('/user/update_password/{id}' , [UserController::class, 'update_password'])->name('user.update_password');
Route::put('/user/update_password/{id}' , [UserController::class, 'do_update_password'])->name('user.do_update_password');

// ========== Intervention planifiées ==========
Route::get('/intervention_planifiee', [InterventionPlanifieeController::class, 'show'])->name('intervention_planifiee');
Route::get('/intervention_planifiee/detail/{id}', [InterventionPlanifieeController::class, 'detail'])->name('intervention_planifiee.detail');
Route::get('/intervention_planfiee/add', [InterventionPlanifieeController::class, 'add'])->name('intervention_planifiee.add');
Route::post('/intervention_planifiee/do_add', [InterventionPlanifieeController::class, 'do_add'])->name('intervention_planifiee.do_add');
Route::get('intervention_planifiee/update/{id}', [InterventionPlanifieeController::class, 'update'])->name('intervention_planifiee.update');
Route::put('intervention_planifiee/do_update/{id}', [InterventionPlanifieeController::class, 'do_update'])->name('intervention_planifiee.do_update');
Route::delete('intervention_planifiee/delete/{id}', [InterventionPlanifieeController::class, 'do_delete'])->name('intervention_planifiee.do_delete');

// ========== Planning ===========
Route::get('/planning', [PlanningController::class, 'planning'])->name('planning');

// ========== Analytique ==========
Route::get('/analytique', [AnalytiqueController::class, 'analytique'])->name('analytique');
Route::get('/analytique/kpi', [AnalytiqueController::class, 'kpi'])->name('analytique.kpi');
Route::get('/anaylique/analyse_machine', [AnalytiqueController::class, 'analyse_machine'])->name('analytique.analyse_machine');
Route::get('/analytique/analyse_intervention', [AnalytiqueController::class, 'analyse_intervention'])->name('analytique.analyse_intervention');
Route::get('/analytique/analyse_intervention_planifiee', [AnalytiqueController::class, 'analyse_intervention_planifiee'])->name('analytique.analyse_intervention_planifiee');
Route::get('/analytique/performance_technicien', [AnalytiqueController::class, 'performance_technicien'])->name('analytique.performance_technicien');

// ========== Error 404 : doit être la dernière route ==========
Route::fallback(function () {
    return view('error.404');
});
