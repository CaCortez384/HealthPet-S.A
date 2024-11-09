<?php

use App\Http\Controllers\DeudaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WebpayController;
use App\Http\Controllers\CarritoController;


#rutas uri para acceder mediante el navegador

Route::get('/', [HomeController::class, 'index'])->middleware('role:admin')->name('inicio');

Route::get('/nose', [HomeController::class, 'nose'])->name('welcome');

//rutas para gestion de inventario

// esta ruta tiene restriccion de acceso, solo admin puede ingresar. 
Route::get('/inventario', [InventarioController::class, 'listar'])->middleware('role:admin')->name('listar.productos');
Route::get('/inventario/crear', [InventarioController::class, 'crear'])->middleware('role:admin')->name('inventario.crear');
Route::post('/inventario', [InventarioController::class, 'store'])->middleware('role:admin')->name('inventario.store');
Route::get('/inventario/{producto}/editar', [InventarioController::class, 'editar'])->middleware('role:admin')->name('editar.producto');
ROUTE::put('/inventario/{producto}', [InventarioController::class, 'update'])->middleware('role:admin')->name('actualizar.producto');
Route::delete('/inventario/{producto}', [InventarioController::class, 'eliminar'])->middleware('role:admin')->name('eliminar.producto');
// validar id del producto antes de agregar
Route::get('/validar-codigo/{codigo}', [InventarioController::class, 'validarCodigo'])->middleware('role:admin')->name('inventario.validarCodigo');
// validar id del producto antes de aditar producto
Route::get('/validar-codigo/{codigo}/{id}', [InventarioController::class, 'validarCodigoEdit'])->middleware('role:admin')->name('inventario.validarCodigoEdit');
Route::get('/inventario/detalle2/{id}', [InventarioController::class, 'detallee'])->middleware('role:admin')->name('detalle2.producto');



// rutas para el login

Route::get('/login', [LoginController::class, 'loguearse'])->name('login');
Route::view('/registro', "login.register")->name('registro');
Route::view('/registro-admin', "login.registerAdmin")->middleware('role:admin')->name('registro-admin');
Route::get('/usuarios', [LoginController::class, 'listarUsuarios'])->middleware('role:admin')->name('listar.usuarios');
Route::delete('/usuarios/{id}', [LoginController::class, 'destroy'])->middleware('role:admin')->name('usuarios.destroy');
Route::get('/usuarios/{id}/edit', [LoginController::class, 'edit'])->middleware('role:admin')->name('usuarios.edit');
Route::put('/usuarios/{id}', [LoginController::class, 'update'])->middleware('role:admin')->name('usuarios.update');
Route::post('/validar-registro', [LoginController::class, 'register'])->name('validar-regitro');
Route::post('/admin-registro', [LoginController::class, 'registerAdmin'])->middleware('role:admin')->name('validar-regitro-admin');
Route::post('/iniciar-sesion', [LoginController::class, 'login'])->name('iniciar-sesion');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Rutas para ventas
Route::get('/ventas', [VentaController::class, 'listarVentas'])->middleware('role:admin')->name('ventas.index'); // Mostrar todas las ventas
Route::get('/ventas/create', [VentaController::class, 'create'])->middleware('role:admin')->name('ventas.create'); // Formulario para crear una nueva venta
Route::post('/ventas', [VentaController::class, 'store'])->middleware('role:admin')->name('ventas.store'); // Guardar una nueva venta
Route::get('/ventas/{id}', [VentaController::class, 'show'])->middleware('role:admin')->name('ventas.show'); // Ver el detalle de una venta específica
// Route::get('/ventas/{id}/edit', [VentaController::class, 'edit'])->name('ventas.edit'); // Formulario para editar una venta
Route::put('/ventas/{id}', [VentaController::class, 'update'])->middleware('role:admin')->name('ventas.update'); // Actualizar una venta existente
Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->middleware('role:admin')->name('ventas.destroy'); // Eliminar una venta

// Mostrar el formulario para editar una venta
Route::get('/ventas/{id}/edit', [VentaController::class, 'edit'])->middleware('role:admin')->name('ventas.edit');

// Actualizar una venta (manteniendo el ID)
Route::put('/ventas/{id}', [VentaController::class, 'actualizarVenta'])->middleware('role:admin')->name('ventas.update');

// Devolver el stock de una venta y mantenerla
Route::post('/ventas/{id}/devolver-stock', [VentaController::class, 'devolverStock'])->middleware('role:admin')->name('ventas.devolverStock');



Route::get('/venta/{id}/recibo', [VentaController::class, 'exportPdf'])->middleware('role:admin')->name('venta.recibo');

// routes/api.php
Route::get('/buscar-productos', [InventarioController::class, 'buscar'])->middleware('role:admin')->name('buscar-productos');

//rutas para deudas
//rutas para deudas
Route::get('/deudas', [DeudaController::class, 'listarDeudas'])->middleware('role:admin')->name('deudas.index');
Route::get('/deudas/{id}', [DeudaController::class, 'detalleDeuda'])->middleware('role:admin')->name('deuda.detalle');
Route::get('/deudas/pagar', [DeudaController::class, 'create'])->middleware('role:admin')->name('pago.create'); // Formulario para pagar una deuda
Route::post('/pago/store', [DeudaController::class, 'storePago'])->middleware('role:admin')->name('pago.store'); // Guardar un pago




// Rutas para la web aqui abajo
Route::get('/home', [WebController::class, 'inicio'])->name('home');
Route::get('/home/prueba', [WebController::class, 'prueba1'])->name('prueba1');
Route::get('/petshop', [WebController::class, 'petShop'])->name('petshop');
Route::get('/detalle/{id}', [WebController::class, 'detalle'])->name('detalle');

// Ruta para agregar al carrito
Route::get('cart', [CarritoController::class, 'showCartSlide']);
Route::get('add-to-cart/{id}', [CarritoController::class, 'addToCart']);
Route::delete('remove-from-cart', [CarritoController::class, 'removeCartItem']);
Route::get('clear-cart', [CarritoController::class, 'clearCart']);
Route::post('/update-cart', [CarritoController::class, 'updateCart'])->name('update-cart');
Route::get('/get-cart-content', [CarritoController::class, 'getCartContent'])->name('getCartContent');


//rutas para checkout
Route::get('/checkout', [CarritoController::class, 'showCheckout'])->name('checkout');
Route::post('/checkout', [CarritoController::class, 'processCheckout'])->name('processCheckout');
// Route::post('/checkout/procesar-pago', [CarritoController::class, 'procesarPago'])->name('checkout.procesarPago');

Route::get('/webpay/estado-pago', [CarritoController::class, 'webpayStatus'])->name('checkout.status');



// rutas para el webpay
Route::get('/webpay/init', [WebpayController::class, 'init'])->name('webpay.init');
Route::post('/webpay/result', [CarritoController::class, 'confirmPago'])->name('webpay.result');
Route::get('/webpay/result', [WebpayController::class, 'getResult'])->name('webpay.result');
Route::post('/webpay/status', [WebpayController::class, 'getStatus'])->name('webpay.status');
Route::post('/webpay/refund', [WebpayController::class, 'refund'])->name('webpay.refund');



Route::get('/carrito', function () {
    return view('components.carrito-slide');
});


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
