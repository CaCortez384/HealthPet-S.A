<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\LoginController;
use App\Models\Producto;

#rutas uri para acceder mediante el navegador

Route::get('/', [HomeController::class, 'inicio'] )->name('inicio');

Route::get('/nose', [HomeController::class, 'nose'] );

//rutas para gestion de inventario

// esta ruta tiene restriccion de acceso, solo admin puede ingresar. 
//Route::get('/inventario', [InventarioController::class, 'listar'])->middleware('role:admin')->name('listar.productos');
Route::get('/inventario', [InventarioController::class, 'listar'])->name('listar.productos');


Route::get('/inventario/crear', [InventarioController::class, 'crear'])->name('inventario.crear');
Route::post('/inventario', [InventarioController::class, 'store'])->name('inventario.store');


Route::get('/inventario/{producto}/editar', [InventarioController::class, 'editar'] )->name('editar.producto');
ROUTE::put('/inventario/{producto}', [InventarioController::class, 'update'] )->name('actualizar.producto');
Route::delete('/inventario/{producto}', [InventarioController::class, 'eliminar'] )->name('eliminar.producto');

// validar id del producto antes de agregar

Route::get('/validar-codigo/{codigo}', [InventarioController::class, 'validarCodigo'])->name('inventario.validarCodigo');

// validar id del producto antes de aditar producto

Route::get('/validar-codigo/{codigo}/{id}', [InventarioController::class, 'validarCodigoEdit'])->name('inventario.validarCodigoEdit');

Route::get('/inventario/detalle2/{id}', [InventarioController::class, 'detallee'])->name('detalle2.producto');

// //BELEN EDITO AQUI//
// Route::get('/inventario/detalle/{id}', [InventarioController::class, 'detalle'])->name('detalle.producto');
// ///


// rutas para el login

Route::view('/login',"login.login")->name('login');
Route::view('/registro',"login.register")->name('registro');

Route::post('/validar-registro', [LoginController::class, 'register'])-> name('validar-regitro');
Route::post('/iniciar-sesion', [LoginController::class, 'login'])-> name('iniciar-sesion');
Route::get('/logout', [LoginController::class, 'logout'])-> name('logout');

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



