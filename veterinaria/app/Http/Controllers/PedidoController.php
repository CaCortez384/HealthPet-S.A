<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use App\Models\DetallePedido;
use Illuminate\Support\Facades\Auth;



use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function listar(Request $request)
    {
        $filtros = [
            'Numero_pedido' => request('numero_pedido'),
            'Estado_pedido' => request('estado_pedido'),
        ];

        $query = Pedido::where('estado_pago', '!=', 0);

        if (!empty($filtros['Numero_pedido'])) {
            $query->where('id', 'like', '%' . $filtros['Numero_pedido'] . '%');
        }

        if (!empty($filtros['Estado_pedido'])) {
            $query->where('estado_pedido', $filtros['Estado_pedido']);
        }

        $pedidos = $query->paginate(10);
        $detallesPedido = [];
        foreach ($pedidos as $pedido) {
            $detallesPedido[] = $pedido->detallePedidos;
        }

        return view('pedidos.listaPedidos', compact('pedidos', 'filtros', 'detallesPedido'));
    }

    public function show($id)
    {
        $pedido = Pedido::find($id);

        if (!$pedido) {
            return redirect()->route('pedidos.index')->with('error', 'Pedido no encontrado.');
        }

        // Obtener los detalles de la venta
        $detallesPedido = DetallePedido::where('pedido_id', $id)->get();

        // Formatear los valores numéricos

        $pedido->total = number_format($pedido->total, 0, ',', '.');
        $pedido->monto_pagado = number_format($pedido->monto_pagado, 0, ',', '.');

        return view('pedidos.detallePedidos', compact('pedido', 'detallesPedido'));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::findOrFail($id);
        $pedido->estado_pedido = $request->input('estado_pedido');
        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Estado del pedido ' . $id . ' actualizado correctamente.');
    }



    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();
        return redirect()->route('listar.pedidos');
    }

    public function mostrarPerfil()
    {
        $filtros = [
            'Numero_pedido' => request('numero_pedido'),
            'Estado_pedido' => request('estado_pedido'),
        ];

        $userId = Auth::user()->id;
        $query = Pedido::where('user_id', $userId)->where('estado_pago', '!=', 0);

        if (!empty($filtros['Numero_pedido'])) {
            $query->where('id', 'like', '%' . $filtros['Numero_pedido'] . '%');
        }

        if (!empty($filtros['Estado_pedido'])) {
            $query->where('estado_pedido', $filtros['Estado_pedido']);
        }

        $pedidos = $query->paginate(10);
        $detallesPedido = [];

        foreach ($pedidos as $pedido) {
            $detallesPedido[] = $pedido->detallePedidos;
        }

        return view('profile.mis-pedidos', compact('pedidos', 'filtros', 'detallesPedido', 'userId'));
    }

    public function BuscarPedido(Request $request)
    {
        $filtros = [
            'Numero_pedido' => request('numero_pedido'),
        ];

        $query = Pedido::where('estado_pago', '!=', 0);

        if (!empty($filtros['Numero_pedido'])) {
            $query->where('id', 'like', '%' . $filtros['Numero_pedido'] . '%');
        }

        $pedidos = $query->paginate(10);
        $detallesPedido = [];

        foreach ($pedidos as $pedido) {
            $detallesPedido[] = $pedido->detallePedidos;
        }

        return view('profile.buscarPedidos', compact('pedidos', 'filtros', 'detallesPedido'));
    }
}