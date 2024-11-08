<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use Transbank\Webpay\WebpayPlus\Transaction;

class WebpayController extends Controller
{
    public function init(Request $request)
    {
        $pedidoId = $request->input('pedido_id');
        $transaction = new Transaction();

        // Configura el valor de la transacción basado en el pedido
        $pedido = Pedido::findOrFail($pedidoId);
        $amount = $pedido->total;

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
        $response = $transaction->commit($token);

        // Actualizar el estado del pedido tras el pago exitoso
        if ($response->isApproved()) {
            $pedido = Pedido::findOrFail($request->input('pedido_id'));
            $pedido->estado_pago = 1;
            $pedido->estado_pedido = 2;
            $pedido->save();
        }

        return view('web.estadoPago', ['response' => $response]);
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
