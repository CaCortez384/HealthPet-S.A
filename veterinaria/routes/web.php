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
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ServicioController;
use App\Http\Controllers\CitaController;



// rutas login nueva
use App\Http\Controllers\ProfileController;
use App\Models\Cita;

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
Route::get('/inicio-sesion', [LoginController::class, 'loguearse'])-> name('login');
Route::view('/registro',"login.register")->name('registro');
Route::view('/registro-admin',"login.registerAdmin")->middleware('role:admin')->name('registro-admin');
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
Route::put('/ventas/{id}', [VentaController::class, 'update'])->middleware('role:admin')->name('ventas.update'); // Actualizar una venta existente
Route::delete('/ventas/{id}', [VentaController::class, 'destroy'])->middleware('role:admin')->name('ventas.destroy'); // Eliminar una venta

// Mostrar el formulario para editar una venta
Route::get('/ventas/{id}/edit', [VentaController::class, 'edit'])->middleware('role:admin')->name('ventas.edit');

// Actualizar una venta (manteniendo el ID)
Route::put('/ventas/{id}', [VentaController::class, 'actualizarVenta'])->middleware('role:admin')->name('ventas.update');

// Devolver el stock de una venta y mantenerla
Route::post('/ventas/{id}/devolver-stock', [VentaController::class, 'devolverStock'])->middleware('role:admin')->name('ventas.devolverStock');
// imprimir recibo en PDF
Route::get('/venta/{id}/recibo', [VentaController::class, 'exportPdf'])->middleware('role:admin')->name('venta.recibo');

// routes/api.php
Route::get('/buscar-productos', [InventarioController::class, 'buscar'])->middleware('role:admin')->name('buscar-productos');

//rutas para deudas
Route::get('/deudas', [DeudaController::class, 'listarDeudas'])->middleware('role:admin')->name('deudas.index');
Route::get('/deudas/{id}', [DeudaController::class, 'detalleDeuda'])->middleware('role:admin')->name('deuda.detalle');
Route::get('/deudas/pagar', [DeudaController::class, 'create'])->middleware('role:admin')->name('pago.create'); // Formulario para pagar una deuda
Route::post('/pago/store', [DeudaController::class, 'storePago'])->middleware('role:admin')->name('pago.store'); // Guardar un pago

//rutas para pedidos
Route::get('/pedidos', [PedidoController::class, 'listar'])->middleware('role:admin')->name('pedidos.index');
Route::get('/pedidos/{id}', [PedidoController::class, 'show'])->middleware('role:admin')->name('pedidos.show');
Route::get('/pedidos/{id}/edit', [PedidoController::class, 'edit'])->middleware('role:admin')->name('pedidos.edit');
Route::put('/pedidos/{id}', [PedidoController::class, 'update'])->middleware('role:admin')->name('pedidos.update');



// Rutas para la web aqui abajo
Route::get('/home', [WebController::class, 'inicio'])->name('home');
Route::get('/home/prueba', [WebController::class, 'prueba1'])->name('prueba1');
Route::get('/petshop', [WebController::class, 'petShop'])->name('petshop');
Route::get('/detalle/{id}', [WebController::class, 'detalle'])->name('detalle');
Route::get('/filtrar-productos', [WebController::class, 'filterCategory']);





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
Route::get('/webpay/estado-pago', [CarritoController::class, 'webpayStatus'])->name('checkout.status');



// rutas para el webpay
Route::get('/webpay/init', [WebpayController::class, 'init'])->name('webpay.init');
Route::post('/webpay/result', [CarritoController::class, 'confirmPago'])->name('webpay.result');
Route::get('/webpay/result', [WebpayController::class, 'getResult'])->name('webpay.result');
Route::post('/webpay/status', [WebpayController::class, 'getStatus'])->name('webpay.status');
Route::post('/webpay/refund', [WebpayController::class, 'refund'])->name('webpay.refund');
// rutas para perfil de usuario y pedidos
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/mis-pedidos', [PedidoController::class, 'mostrarPerfil'])->name('profile.pedidos');
});

Route::get('/buscar-pedido', [PedidoController::class, 'BuscarPedido'])->name('buscar.pedido');

require __DIR__.'/auth.php';

//rutas para agendar citas
// Route::resource('citas', CitaController::class);
// Route::resource('servicios', ServicioController::class);

Route::get('/citas/crear', [CitaController::class, 'create'])->name('citas.create');
Route::post('/citas/crear', [CitaController::class, 'store'])->name('citas.store');
Route::get('appointments/available-times', [CitaController::class, 'availableTimes']);

