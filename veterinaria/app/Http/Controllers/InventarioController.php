<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Unidad;
use App\Models\Presentacion;

class InventarioController extends Controller
{
    public function listar(Request $request) {
        $query = Producto::query();
    
        // Obtener los filtros de la solicitud desde el formulario de la vista
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
        $presentaciones = Presentacion::all(); // Obtener las presentaciones disponibles
    
        // Pasar los filtros aplicados a la vista además de los productos y categorías
        return view('inventario.listar', [
            'productos' => $productos,
            'categorias' => $categorias,
            'presentaciones' => $presentaciones,
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
        $presentaciones = Presentacion::all();
        return view('inventario/crear', ['categorias' => $categorias, 'unidades' => $unidades, 'presentaciones' => $presentaciones]);
    }


    
    //guarda los datos del formulario
    public function store(Request $request){
        // Validar el código antes de guardar
        $existe = Producto::where('codigo', $request->codigo)->exists();
        if ($existe) {
            return redirect()->back()->with('error', 'El código del producto ya existe.');
        }

        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->codigo = $request->codigo;
        $producto->precio_de_compra = $request->precio_de_compra;
        $producto->precio_de_venta = $request->precio_de_venta;
        $producto->precio_fraccionado = $request->precio_fraccionado;
        $producto->id_unidad = $request->unidad;
        $producto->id_presentacion = $request->presentacion;
        $producto->id_categoria = $request->categoria;
        $producto->stock_unidades = $request->stock_unidades;

        $producto->ml_por_unidad = $request->ml_por_unidad;
        $producto->stock_total_ml = $request->ml_por_unidad * $request->stock_unidades; // Calcular stock_total_ml

        $producto->comprimidos_por_caja = $request->comprimidos_por_caja;
        $producto->stock_total_comprimidos = $request->comprimidos_por_caja * $request->stock_unidades; // Calcular stock_total_comprimidos

        $producto->vende_a_granel = $request->vende_a_granel;
        $producto->unidades_por_envase = $request->unidades_por_envase;
        $producto->unidades_granel_total = $request->unidades_por_envase * $request->stock_unidades; // Calcular unidades_granel_total

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
        $presentaciones = Presentacion::all();
        $producto = Producto::find($producto);
        //formatea la fecha de vencimiento
        return view('inventario/editar',compact('producto'), ['categorias' => $categorias, 'unidades' => $unidades, 'presentaciones' => $presentaciones]);
    }

    public function update(Request $request, $producto){
        $producto = Producto::find($producto);
        if ($producto === null) {
            return redirect()->route('listar.productos')->with('error', 'Producto no encontrado.');
        }
    
        // Guardar el valor actual de id_presentacion antes de actualizarlo
        
    
        // Actualizar los valores del producto
        $producto->nombre = $request->nombre;
        $producto->codigo = $request->codigo;
        $producto->precio_de_compra = $request->precio_de_compra;
        $producto->precio_de_venta = $request->precio_de_venta;
        $producto->id_unidad = $request->unidad;
        $producto->id_categoria = $request->categoria;
        $producto->stock_unidades = $request->stock_unidades;
            
        // Insertar nuevos valores
        
        
        // Guardar el producto actualizado en la base de datos
        $producto->id_presentacion = $request->presentacion;

        switch ($request->presentacion) {
            case 1:
            $producto->comprimidos_por_caja = $request->comprimidos_por_caja;
            $producto->stock_total_comprimidos = $request->comprimidos_por_caja * $request->stock_unidades;
            $producto->precio_fraccionado = $request->precio_fraccionado;
            $producto->ml_por_unidad = null;
            $producto->stock_total_ml = null;
            $producto->unidades_por_envase = null;
            $producto->unidades_granel_total = null;
            break;
            case 2:
            $producto->ml_por_unidad = $request->ml_por_unidad;
            $producto->stock_total_ml = $request->ml_por_unidad * $request->stock_unidades;
            $producto->precio_fraccionado = $request->precio_fraccionado;
            $producto->comprimidos_por_caja = null;
            $producto->stock_total_comprimidos = null;
            $producto->unidades_por_envase = null;
            $producto->unidades_granel_total = null;
            break;
            case 3:
            $producto->vende_a_granel = $request->vende_a_granel;
            $producto->unidades_por_envase = $request->unidades_por_envase;
            $producto->unidades_granel_total = $request->unidades_por_envase * $request->stock_unidades;
            $producto->precio_fraccionado = $request->precio_fraccionado;
            $producto->comprimidos_por_caja = null;
            $producto->stock_total_comprimidos = null;
            $producto->ml_por_unidad = null;
            $producto->stock_total_ml = null;
            break;
            default:
            $producto->comprimidos_por_caja = null;
            $producto->stock_total_comprimidos = null;
            $producto->ml_por_unidad = null;
            $producto->stock_total_ml = null;
            $producto->unidades_por_envase = null;
            $producto->unidades_granel_total = null;
            $producto->precio_fraccionado = null;
            break;
        }
        $producto->save();
    
        return redirect()->route('listar.productos')->with('success', 'Producto actualizado correctamente');
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

    public function detallee($id) {
        // Busca el producto por ID
        $producto = Producto::find($id);
        $categorias = Categoria::all();
        $unidades = Unidad::all();
        $presentaciones = Presentacion::all();
        
        // Verifica si el producto existe
        if ($producto === null) {
            return redirect()->route('listar.productos')->with('error', 'Producto no encontrado.');
        }

        // Devuelve la vista detalle2 y pasa el producto encontrado junto con las categorías, unidades y presentaciones
        return view('inventario.detalle2', [
            'producto' => $producto,
            'categorias' => $categorias,
            'unidades' => $unidades,
            'presentaciones' => $presentaciones
        ]);
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

    public function detalle2(){
        return view('inventario/detalle2');
    }

}
