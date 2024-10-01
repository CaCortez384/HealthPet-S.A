<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



Route::get('/nose', [HomeController::class, 'nose'] );

Route::get('/post', function(){
    return "holas";
});

Route::get('/inventario', [HomeController::class, 'inventario'] );

