<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'] );

Route::get('/nose', [HomeController::class, 'nose'] );

Route::get('/inventario', [HomeController::class, 'listar'] );
