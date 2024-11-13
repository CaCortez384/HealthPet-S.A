<?php

// WebController.php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Producto; // Asegúrate de importar tu modelo de Producto
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function inicio() {
        return view('web.home');
    }

    public function prueba1() {
        return view('web.prueba1');
    }

    // Método para PetShop
    public function petShop() {
        // Aquí puedes filtrar los productos que pertenecen a la categoría de alimentos
        // Supongamos que '1' es el id de la categoría de alimentos en tu base de datos
        $productos = Producto::where('mostrar_web', 1)->get(); 

        return view('web.petshop', compact('productos')); 
    }
    public function detalle($id) {
        // Buscar el producto por su ID
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('web.detalle', compact('producto')); 
    }
}

    

