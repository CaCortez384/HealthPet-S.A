<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Unidad;

class InventarioController extends Controller
{
    public function listar(Request $request){
        $query = Producto::query();
    
        $nombre = $request->input('nombre');
        $categoria = $request->input('categoria');
    
        if ($nombre) {
            $query->where('nombre', 'like', '%' . $nombre . '%');
        }
    
        if ($categoria) {
            $query->where('id_categoria', $categoria);
        }
    
        $productos = $query->get();
        $categorias = Categoria::all(); // Asegúrate de obtener las categorías aquí
    
        // Retorna la vista con los productos filtrados y las categorías para mostrar en el select
        return view('inventario/listar', ['productos' => $productos, 'categorias' => $categorias]);
    }

    //funcion para redirigir y crear nuevos productos
    public function crear(){
        //obtiene las categorias y unidades de la base de datos para mostrar en los select
        $categorias = Categoria::all();
        $unidades = Unidad::all();
        return view('inventario/crear', ['categorias' => $categorias, 'unidades' => $unidades]);
    }
    
    //guarda los datos del formulario
    public function store(Request $request){
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->id_categoria = $request->categoria;
        $producto->codigo = $request->codigo;
        $producto->precio_de_compra = $request->precio_de_compra;
        $producto->precio_de_venta = $request->precio_de_venta;
        $producto->id_unidad = $request->unidad;
        $producto->stock = $request->stock;
        $producto->fecha_de_vencimiento = $request->fecha_de_vencimiento;
        $producto->cantidad_minima_requerida = $request->cantidad_minima_requerida;
        $producto->save();
        //redirecciona a la lista de productos atraves de la ruta listar.productos (al retornar una vista return view('inventario/listar') no funciona;)
        return redirect()->route('listar.productos');
    }

    public function editar($producto){
        $categorias = Categoria::all();
        $unidades = Unidad::all();
        $producto = Producto::find($producto);
        //formatea la fecha de vencimiento
        return view('inventario/editar',compact('producto'), ['categorias' => $categorias, 'unidades' => $unidades]);
    }

    public function update(Request $request, $producto){
        $producto = Producto::find($producto);
        if ($producto === null) {
            return redirect()->route('listar.productos')->with('error', 'Producto no encontrado.');
        }
        $producto->nombre = $request->nombre;
        $producto->id_categoria = $request->categoria;
        $producto->codigo = $request->codigo;
        $producto->precio_de_compra = $request->precio_de_compra;
        $producto->precio_de_venta = $request->precio_de_venta;
        $producto->id_unidad = $request->unidad;
        $producto->stock = $request->stock;
        $producto->fecha_de_vencimiento = $request->fecha_de_vencimiento;
        $producto->cantidad_minima_requerida = $request->cantidad_minima_requerida;
        $producto->save();
        return redirect()->route('listar.productos');
    }

    public function detalle(){
        return view('detalle/producto');
    }

    public function eliminar($producto){
        $producto = Producto::find($producto);
        if ($producto === null) {
            return redirect()->route('listar.productos')->with('error', 'Producto no encontrado.');
        }
        $producto->delete();
        return redirect()->route('listar.productos');
    }

}
