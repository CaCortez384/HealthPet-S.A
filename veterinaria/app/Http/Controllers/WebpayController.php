<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Transbank\Webpay\WebpayPlus\Transaction;

class WebpayController extends Controller
{
    public function init()
    {
        $transaction = new Transaction();
        $response = $transaction->create(
            'order' . rand(),
            'session' . rand(),
            150000000, //valor a pagar
            route('webpay.result')
        );

        return view('webpay.init', ['response' => $response]);
    }

    public function getResult(Request $request)
    {
        $token = $request->input('token_ws');
        $transaction = new Transaction();
        $response = $transaction->commit($token);

        return view('webpay.result', ['response' => $response]);
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
