<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto;


class InventarioController extends Controller
{
    public function listar(){
        //trae todos los productos
        $productos = Producto::all();
        $productos = Producto::with('categoria')->get();
        return view('inventario.listar', compact('productos'));
    }

    public function crear(){
        return view('inventario.crear');
    }
    
    //guarda los datos del formulario
    public function store(Request $request){
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->codigo = $request->codigo;
        $producto->precio_de_compra = $request->precio_de_compra;
        $producto->precio_de_venta = $request->precio_de_venta;
        $producto->unidades = $request->unidades;
        $producto->stock = $request->stock;
        $producto->fecha_de_vencimiento = $request->fecha_de_vencimiento;
        $producto->cantidad_minima_requerida = $request->cantidad_minima_requerida;
        $producto->save();
        return redirect('/inventario');
    }

    public function editar(){
        return view('inventario.editar');
    }

    public function detalle(){
        return view('inventario/detalle');
    }
}
