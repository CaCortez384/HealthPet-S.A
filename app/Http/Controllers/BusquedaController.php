<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Venta;

class BusquedaController extends Controller
{
    public function buscar(Request $request)
    {
        $query = $request->input('query');


        // Buscar productos por nombre
        $resultados = Producto::where('nombre', 'LIKE', "%$query%")
            ->take(10) // Limitar resultados
            ->get()
            ->map(function ($producto) {
                return ['tipo' => 'producto', 'id' => $producto->id, 'nombre' => $producto->nombre, 'precio' => $producto->precio_de_venta];
            });


        return response()->json($resultados);
    }
}
