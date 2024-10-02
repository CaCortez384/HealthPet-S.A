<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarioController;
use App\Models\Producto;

#rutas uri para acceder mediante el navegador

Route::get('/inicio', [HomeController::class, 'inicio'] );

Route::get('/nose', [HomeController::class, 'nose'] );

Route::get('/inventario', [InventarioController::class, 'listar'] );

Route::get('/inventario/crear', [InventarioController::class, 'crear'] );
Route::post('/inventario', [InventarioController::class, 'store'])->name('inventario.store');

Route::get('/inventario/editar', [InventarioController::class, 'editar'] );

Route::get('/inventario/detalle', [InventarioController::class, 'detalle'] );

//Route::get('/prueba', function () {
    #crear producto
    // $producto = new Producto();
    // $producto->nombre = 'Producto 1';
    // $producto->codigo = 152;
    // $producto->precio_de_compra = 100;
    // $producto->precio_de_venta = 100;
    // $producto->unidades = 'ml';
    // $producto->stock = 10;
    // $producto->fecha_de_vencimiento = '2021-12-31';
    // $producto->cantidad_minima_requerida = 5;
    // $producto->save();
    // return $producto;

    #buscar producto
    // $producto = Producto::where('codigo', 1234)->first();
    // return $producto;

    #actualizar producto
    // $producto = Producto::where('codigo', 1234)->first();
    // $producto->precio_de_venta = 10000;
    // $producto->save();
    // return $producto;

    #eliminar producto
    // $producto = Producto::where('codigo', 152)->first();
    // $producto->delete();
    // return $producto;

    #listar productos
    //$productos = Producto::all();
    //return $productos;

    #este codigo devuelve la fecha formateada
    //$producto= Producto::find(1);
    //return $producto->created_at->format('d/m/Y');


//});

