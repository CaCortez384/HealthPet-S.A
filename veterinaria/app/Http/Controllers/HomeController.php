<?php

namespace App\Http\Controllers;

use App\Models\Producto; // Asegúrate de importar el modelo Producto
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function inicio()
    {
        // Obtener productos con stock por debajo del mínimo requerido
        $productosBajoStock = Producto::whereColumn('stock_unidades', '<', 'cantidad_minima_requerida')->get();

        // Pasar los productos a la vista
        return view('components.app-layout', [
            'productosBajoStock' => $productosBajoStock,
        ]);
    }

    public function index()
    {
        // Obtener productos con stock por debajo del mínimo requerido
        $productosBajoStock = Producto::whereColumn('stock_unidades', '<', 'cantidad_minima_requerida')->get();

        // Pasar los productos a la vista
        return view('home', [
            'productosBajoStock' => $productosBajoStock,
        ]);
    }


    
    public function nose()
    {


        // Pasar los productos a la vista
        return view('welcome');
    }
}
