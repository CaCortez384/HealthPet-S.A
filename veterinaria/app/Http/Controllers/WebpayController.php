<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\DetallePedido;
use Transbank\Webpay\WebpayPlus\Transaction;
use App\Mail\MiCorreo;
use Illuminate\Support\Facades\Mail;

class WebpayController extends Controller
{
    public function init(Request $request)
    {
        $pedidoId = $request->input('pedido_id');
        $transaction = new Transaction();

        // Configura el valor de la transacción basado en el pedido
        $pedido = Pedido::findOrFail($pedidoId);
        $amount = $pedido->monto_pagado;

        $response = $transaction->create(
            'order' . $pedidoId,
            'session' . rand(),
            $amount,
            route('webpay.result', ['pedido_id' => $pedidoId])
        );

        return view('webpay.init', ['response' => $response]);
    }


    public function getResult(Request $request)
    {
        $token = $request->input('token_ws');
        $transaction = new Transaction();

        try {
            // Intentamos confirmar la transacción
            $response = $transaction->commit($token);
        } catch (\Transbank\Webpay\WebpayPlus\Exceptions\TransactionCommitException $e) {
            // Captura la excepción si la transacción no puede ser confirmada
            session()->flash('errors', 'El pago fue cancelado o no aprobado. Intenta nuevamente.');
            // Redirigir a la ruta 'web.petshop' con el mensaje de error
            return redirect()->route('petshop')->with('errors', 'El pago fue cancelado o no aprobado. Intenta nuevamente.');
        }

        // Crear instancia de CarritoController y llamar a procesarPagoConAPI
        $carritoController = new CarritoController();
        $isPaymentApproved = $carritoController->procesarPagoConAPI([
            'aprobado' => $response->isApproved()
        ]);

        // Obtener el pedido
        $pedido = Pedido::findOrFail($request->input('pedido_id'));

        if ($isPaymentApproved) {
            // Verificar y descontar stock de los productos en el pedido
            $productos = DetallePedido::where('pedido_id', $pedido->id)->get();
            $hayFaltaDeStock = false;

            foreach ($productos as $detalle) {
                $producto = Producto::find($detalle->id_producto);
                if ($producto) {
                    if ($producto->stock_unidades >= $detalle->cantidad) {
                        // Descontar el stock si hay suficiente
                        $producto->stock_unidades -= $detalle->cantidad;
                        $producto->save();
                    } else {
                        // Marcar que al menos un producto no tiene suficiente stock
                        $hayFaltaDeStock = true;
                    }
                } else {
                    // Marcar que al menos un producto no se encontró o no tiene stock
                    $hayFaltaDeStock = true;
                }
            }

            // Actualizar estado_pago y estado_pedido
            $pedido->estado_pago = $hayFaltaDeStock ? 1 : 2;
            $pedido->estado_pedido = $hayFaltaDeStock ? 1 : 2;

            // Guardar cambios en el pedido
            $pedido->save();

            $this->enviarCorreo($pedido->id);

            // Limpiar el carrito solo si todos los productos fueron procesados correctamente
            if (!$hayFaltaDeStock) {
                session()->forget('cart');
            }

            return view('web.estadoPago', ['response' => $response, 'isPaymentApproved' => $isPaymentApproved]);
        } else {
            // Si la transacción no fue aprobada o fue cancelada
            $pedido->monto_pagado = 0;
            $pedido->estado_pago = 0;
            $pedido->save();

            // Devolver una respuesta JSON con error
            // Redirigir a la ruta 'web.petshop' con el mensaje de error
            return redirect()->route('petshop')->with('errors', 'El pago fue cancelado o no aprobado. Intenta nuevamente.');
        }
    }

    public function enviarCorreo($pedidoId)
    {
        $pedido = Pedido::findOrFail($pedidoId);
        $datos = [
            'nombre' => 'Carlos',
            'mensaje' => 'Este es un mensaje de prueba.',
            'pedido_id' => $pedido->id,
            'monto_pagado' => $pedido->monto_pagado
        ];

        Mail::to('destinatario@example.com')->send(new MiCorreo($datos));

        return "Correo enviado exitosamente.";
    }

    public function getStatus(Request $request)
    {
        $token = $request->input('token_ws');
        $transaction = new Transaction();
        $response = $transaction->status($token);

        return view('webpay.status', ['response' => $response]);
    }

    public function refund(Request $request)
    {
        $token = $request->input('token_ws');
        $amount = 15000;
        $transaction = new Transaction();
        $response = $transaction->refund($token, $amount);

        return view('webpay.refund', ['response' => $response]);
    }
}
