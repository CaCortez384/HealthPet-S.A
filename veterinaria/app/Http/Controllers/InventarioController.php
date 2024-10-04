<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Unidad;

class InventarioController extends Controller
{
    public function listar(Request $request) {
        $query = Producto::query();
    
        // Obtener los filtros de la solicitud
        $nombre = $request->input('nombre');
        $categoria = $request->input('categoria');
        $codigo = $request->input('codigo');
    
        // Aplicar filtros a la consulta
        if ($nombre) {
            $query->where('nombre', 'like', '%' . $nombre . '%');
        }
    
        if ($categoria) {
            $query->where('id_categoria', $categoria);
        }
    
        if ($codigo) {
            $query->where('codigo', 'like', '%' . $codigo . '%');
        }
    
        // Usar paginate() para obtener productos en lugar de get()
        $productos = $query->paginate(20); // Paginación de 20 productos por página
        $categorias = Categoria::all(); // Obtener las categorías disponibles
    
        // Pasar los filtros aplicados a la vista además de los productos y categorías
        return view('inventario.listar', [
            'productos' => $productos,
            'categorias' => $categorias,
            'filtros' => [
                'nombre' => $nombre,
                'categoria' => $categoria,
                'codigo' => $codigo,
            ],
        ]);
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
        return redirect()->route('listar.productos')->with('success', 'Producto agregado correctamente.');
    }

    // funcion para validar codigo antes de agregar nuevo registro
    public function validarCodigo($codigo)
{
    $existe = Producto::where('codigo', $codigo)->exists();
    return response()->json(['existe' => $existe]);
}

public function validarCodigoEdit(Request $request, $codigo, $id)
{
    // Verifica si existe otro producto con el mismo código que no sea el producto actual
    $existe = Producto::where('codigo', $codigo)
        ->where('id', '!=', $id)
        ->exists();

    // Retorna la respuesta en formato JSON
    return response()->json(['existe' => $existe, 'id' => $existe ? Producto::where('codigo', $codigo)->first()->id : null]);
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

    /* BELEN EDITO AQUII */
    public function detalle($id) {
        // Busca el producto por ID
        $producto = Producto::find($id);
        
        // Verifica si el producto existe
        if ($producto === null) {
            return redirect()->route('listar.productos')->with('error', 'Producto no encontrado.');
        }

        // Devuelve la vista detalle y pasa el producto encontrado
        return view('inventario.detalle', compact('producto'));
    }

/* BELEN EDITO AQUII */

    public function eliminar($producto){
        $producto = Producto::find($producto);
        if ($producto === null) {
            return redirect()->route('listar.productos')->with('error', 'Producto no encontrado.');
        }
        $producto->delete();
        return redirect()->route('listar.productos');
    }

}
