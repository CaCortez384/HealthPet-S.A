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

        return view('web.petShop', compact('productos')); 
    }
    
    public function detalle($id) {
        // Buscar el producto por su ID junto con la categoría y detalleWeb
        $producto = Producto::with(['categoria', 'detalleWeb', 'presentacion', 'unidad'])->findOrFail($id);
        return view('web.detalle', compact('producto')); 
    }

    public function filterCategory(Request $request)
{
    $categoria = $request->input('categoria');  // Recuperamos la categoría seleccionada
    $precioMaximo = $request->input('precio'); // Recuperamos el precio máximo

    // Iniciamos la consulta para filtrar productos
    $query = Producto::query();

   // Filtramos según la categoría seleccionada
   switch ($categoria) {
    case 'perro':
        $query->where('id_categoria', 2) // Alimento
              ->where('id_especie', 1)  // Perro
              ->where('id_presentacion', 4) // Seco
              ->where('mostrar_web', 1); //para la web
        break;
    case 'gato':
        $query->where('id_categoria', 2) // Alimento
              ->where('id_especie', 2)  // Gato
              ->where('id_presentacion', 4) // Seco
              ->where('mostrar_web', 1); //para la web
        break;
    case 'snack-perro':
        $query->where('id_categoria', 2) // Alimento
              ->where('id_especie', 1)  // Perro
              ->where('id_presentacion', 6) // Snack
              ->where('mostrar_web', 1); //para la web
        break;
    case 'snack-gato':
        $query->where('id_categoria', 2) // Alimento
              ->where('id_especie', 2)  // Gato
              ->where('id_presentacion', 6) // Snack
              ->where('mostrar_web', 1); //para la web
        break;
    case 'humedo-perro':
        $query->where('id_categoria', 2) // Alimento
              ->where('id_especie', 1)  // Perro
              ->where('id_presentacion', 5) // Húmedo
              ->where('mostrar_web', 1); //para la web
        break;
    case 'humedo-gato':
        $query->where('id_categoria', 2) // Alimento
              ->where('id_especie', 2)  // Gato
              ->where('id_presentacion', 5) // Húmedo
              ->where('mostrar_web', 1); //para la web
        break;
    default:
        // Si no hay categoría específica seleccionada, traer todos los productos
        $query->where('mostrar_web', 1); //para la web
        break;
}

// Filtrar por precio máximo si se proporcionó
if ($precioMaximo) {
    $query->where('precio_de_venta', '<=', $precioMaximo);
}

$productos = $query->get();

// Verificar si no hay resultados
if ($productos->isEmpty()) {
    return response()->json([
        'success' => false,
        'message' => 'Esta categoría no se encuentra disponible. 😢',
    ]);
}

return response()->json([
    'success' => true,
    'productos' => $productos,
]);
}
}
    

