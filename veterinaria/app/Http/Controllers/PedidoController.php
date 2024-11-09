<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use App\Models\DetallePedido;



use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function listar()
    {
        $pedidos = Pedido::all();
        return view('pedidos.listarPedidos', compact('pedidos'));
    }

    public function show($id)
    {
        $pedido = Pedido::find($id);
        return view('pedidos.detallePedido', compact('pedido'));
    }


    public function edit($id)
    {
        $pedido = Pedido::find($id);
        $productos = Producto::all();
        $usuarios = User::all();
        return view('pedidos.editarPedido', compact('pedido', 'productos', 'usuarios'));
    }

    public function update(Request $request, $id)
    {
        $pedido = Pedido::find($id);
        $pedido->fecha = $request->fecha;
        $pedido->total = $request->total;
        $pedido->user_id = $request->user_id;
        $pedido->save();

        $productos = $request->productos;
        $cantidades = $request->cantidades;
        $precios = $request->precios;

        DetallePedido::where('pedido_id', $pedido->id)->delete();

        for ($i = 0; $i < count($productos); $i++) {
            $detalle = new DetallePedido();
            $detalle->pedido_id = $pedido->id;
            $detalle->producto_id = $productos[$i];
            $detalle->cantidad = $cantidades[$i];
            $detalle->precio = $precios[$i];
            $detalle->save();
        }

        return redirect()->route('listar.pedidos');
    }

    public function destroy($id)
    {
        $pedido = Pedido::find($id);
        $pedido->delete();
        return redirect()->route('listar.pedidos');
    }
}
