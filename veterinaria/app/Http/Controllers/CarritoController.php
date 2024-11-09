<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DetallePedido;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;


class CarritoController extends Controller
{


    public function addToCart($id)
    {
        $producto = Producto::find($id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado.'], 404);
        }

        $cart = session()->get('cart', []);


        // Añadir o incrementar la cantidad del producto en el carrito
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "nombre" => $producto->nombre,
                "quantity" => 1,
                "precio" => $producto->precio_de_venta,
                "imagen" => $producto->imagen,
                "stock" => $producto->stock_unidades
            ];
        }

        session()->put('cart', $cart);

        // Renderizar el HTML del componente del carrito usando una vista Blade
        $view = view('components.carrito-slide', ['cart' => $cart])->render();

        // Responder con JSON para actualizar el carrito en el frontend
        return response()->json(['carrito_html' => $view, 'message' => 'Producto añadido al carrito con éxito']);
    }

    public function showCartSlide()
    {

        $productos = Producto::all();
        return view('components.carrito-slide', compact('productos'));
    }


    public function getCartContent()
    {
        $cart = session('cart', []);
        $subtotal = 0;
        $total_con_stock = 0;
        $total_sin_stock = 0;
        $descuentos = []; // Arreglo para almacenar descuentos individuales

        foreach ($cart as $id => $details) {
            $cantidad = $details['quantity'];
            $precio = str_replace('.', '', $details['precio']);
            $precio = (float) $precio;

            $subtotal += $precio * $cantidad;

            if ($details['stock'] > 0) {
                $total_con_stock += $precio * $cantidad;
            } else {
                // Calcula el 50% del precio por cantidad y lo almacena en el arreglo de descuentos
                $descuento_individual = ($precio * $cantidad) / 2;
                $descuentos[$id] = $descuento_individual; // Guarda el descuento para este producto
                $total_sin_stock += $descuento_individual;
            }
        }

        $total_pedido = $total_con_stock + $total_sin_stock;

        $html = view('components.carrito-slide-content', compact('cart', 'descuentos'))->render();

        return response()->json([
            'html' => $html,
            'subtotal' => $subtotal,
            'total_pedido' => $total_pedido,
            'total' => $total_pedido,
            'descuentos' => $descuentos, // Pasa todos los descuentos individuales al frontend
        ]);
    }

    public function showCheckout()
    {
        $cart = session('cart', []);
        $subtotal2 = 0; // Precio total sin ajustes de stock
        $total_con_stock = 0;
        $total_sin_stock = 0;
        $descuentos = []; // Arreglo para almacenar descuentos individuales

        foreach ($cart as $id => $details) {
            $cantidad = $details['quantity'];
            $precio = str_replace('.', '', $details['precio']);
            $precio = (float) $precio;

            // Calcular el subtotal considerando siempre el precio completo
            $subtotal2 += $precio * $cantidad;

            // Si hay stock, cobra el precio completo; si no, cobra la mitad
            if ($details['stock'] > 0) {
                $total_con_stock += $precio * $cantidad;
                $descuentos[$id] = 0;
            } else {
                // Calcula el 50% del precio por cantidad y lo almacena en el arreglo de descuentos
                $descuento_individual = ($precio * $cantidad) / 2;
                $descuentos[$id] = $descuento_individual; // Guarda el descuento para este producto
                $total_sin_stock += $descuento_individual;
            }
        }

        // El total a pagar ajustado para reflejar productos sin stock
        $total_pedido = $total_con_stock + $total_sin_stock;

        return view('web.checkout', compact('cart', 'subtotal2', 'total_pedido', 'total_con_stock', 'total_sin_stock', 'descuentos'));
    }


    public function processCheckout(Request $request)
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'El carrito está vacío.');
        }

        // Crear el pedido sin confirmación de pago
        $pedido = $this->crearPedido($request, false);

        // Redirigir a WebpayController para procesar el pago
        return redirect()->route('webpay.init', ['pedido_id' => $pedido->id]);
    }


    public function checkoutSuccess()
    {
        return view('web.checkout-success');
    }

    public function updateCart(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->id;
        $action = $request->action;

        if (isset($cart[$id])) {
            if ($action == 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($action == 'decrease') {
                $cart[$id]['quantity']--;
                if ($cart[$id]['quantity'] <= 0) {
                    unset($cart[$id]);
                }
            } elseif ($action == 'remove') {
                unset($cart[$id]);
            }
        }

        session(['cart' => $cart]);

        return response()->json(['success' => true]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session(['cart' => $cart]);

        return response()->json(['success' => true]);
    }

    public function procesarPago(Request $request)
    {
        // Validar los datos del formulario (descomentar en producción)
        // $request->validate([
        //     'nombre' => 'required|string|max:255',
        //     'correo' => 'required|email|max:255',
        //     'telefono' => 'required|regex:/\+569[0-9]{8}/',
        // ]);

        // Procesar el pago mediante API
        if (!$this->procesarPagoConAPI($request->all())) {
            return response()->json(['error' => 'El pago no se pudo procesar. Inténtalo de nuevo.'], 400);
        }

        // Verificar stock de productos
        $todosConStock = $this->verificarStock($request->productos);

        // Crear el pedido con el estado adecuado según el stock
        DB::beginTransaction();
        try {
            // Si todos tienen stock, establecer los estados en 1, de lo contrario en 0
            $pedido = $this->crearPedido($request, $todosConStock);
            if ($todosConStock) {
                $this->actualizarStock($request->productos);
            }

            // Limpiar carrito y confirmar éxito
            session()->forget('cart');
            DB::commit();
            return response()->json(['success' => true, 'message' => 'Pago realizado con éxito.', 'pedido' => $pedido]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Hubo un problema al procesar el pedido. Inténtalo de nuevo.'], 500);
        }
    }

    // Método para verificar si hay stock suficiente para cada producto
    private function verificarStock(array $productos): bool
    {
        foreach ($productos as $productoData) {
            $producto = Producto::find($productoData['id_producto']);
            if (!$producto || $producto->stock_unidades < $productoData['cantidad']) {
                return false;
            }
        }
        return true;
    }

    // Método para actualizar el stock de los productos vendidos
    private function actualizarStock(array $productos): void
    {
        foreach ($productos as $productoData) {
            $producto = Producto::find($productoData['id_producto']);
            if ($producto) {
                $producto->stock_unidades -= $productoData['cantidad'];
                $producto->save();
            }
        }
    }

    private function crearPedido(Request $request, bool $todosConStock): Pedido
    {
        $pedido = new Pedido();
        $pedido->user_id = Auth::id();
        $pedido->nombre_cliente = $request->nombre;
        $pedido->email_cliente = $request->correo;
        $pedido->telefono_cliente = $request->telefono;
        $pedido->total =  $request->total_pedido;
        $pedido->monto_pagado = $request->total;
        $pedido->estado_pago = 0; // Estado de pago depende del stock
        $pedido->estado_pedido = 0; // Estado del pedido depende del stock
        $pedido->save();

        // Crear detalles del pedido
        $this->crearDetallesPedido($pedido->id, $request->productos, $request);

        return $pedido;
    }

    private function crearDetallesPedido(int $pedidoId, array $productos, Request $request): void
    {
        foreach ($productos as $productoData) {
            $producto = Producto::find($productoData['id_producto']);

            if ($producto) {
                $detallePedido = new DetallePedido();
                $detallePedido->pedido_id = $pedidoId;
                $detallePedido->id_producto = $producto->id;
                $detallePedido->cantidad = $productoData['cantidad'];
                $detallePedido->precio = str_replace('.', '', $productoData['precio']);
                $detallePedido->subtotal = $request->total;
                $detallePedido->descuento = $productoData['descuento'] ?? 0;
                $detallePedido->tipo_pago_id = $request->metodo_pago;
                $detallePedido->nota = $request->nota ?? '';
                $detallePedido->save();
            } else {
                // Manejo de error si el producto no existe
                throw new \Exception("Producto con ID {$productoData['id_producto']} no encontrado.");
            }
        }
    }

    public function procesarPagoConAPI($datos)
    {
        // Lógica de validación del pago
        if ($datos['aprobado']) {
            return true;
        } else {
            return false;
        }
    }
}
