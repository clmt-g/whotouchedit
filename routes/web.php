<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DefaultController;

// ========== Home ==========
Route::get('/', [DefaultController::class, 'index']);
