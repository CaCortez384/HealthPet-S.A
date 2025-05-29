<?php

namespace App\Http\Controllers;

use App\Models\Producto; // Asegúrate de importar el modelo Producto
use Illuminate\Http\Request;

class ProductoWebController extends Controller
{
    public function petShop()
    {
        // Obtener solo los productos que son alimentos
        $productos = Producto::where('tipo', 'alimento')->get();

        // Retornar la vista con los productos
        return view('petshop', compact('productos'));
    }
}
