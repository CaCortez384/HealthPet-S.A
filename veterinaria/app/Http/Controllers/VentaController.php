<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Deuda;
use App\Models\TipoPago;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class VentaController extends Controller
{

    public function create()
    {
        // Obtener todos los productos desde la base de datos
        $productos = Producto::all();
        $tipoPago = TipoPago::all();

        // Retornar la vista del formulario con la lista de productos
        return view('ventas.create', compact('productos', 'tipoPago'));
    }

    public function listarVentas(Request $request)
    {
        $filtros = [
            'rut' => $request->input('rut', ''),
            'deuda' => $request->input('deuda', null),
        ];

        // Filtrar ventas según los valores de los filtros
        $ventas = venta::query();

        if (!empty($filtros['rut'])) {
            $ventas->where('rut_cliente', 'like', '%' . $filtros['rut'] . '%');
        }

        if (!is_null($filtros['deuda'])) {
            $ventas->where('estado_pago', $filtros['deuda']);
        }

        $ventas = $ventas->paginate(10);

        return view('ventas.listar', compact('ventas', 'filtros'));
    }


    public function store(Request $request)
    {
        // Validación de datos
        $request->validate([
            'nombre_cliente' => 'nullable|string|max:255',
            'rut_cliente' => 'nullable|string|max:12', // O ajusta según tu validación de RUT
            'nota' => 'nullable|string|max:255', // notas venta
            'productos' => 'required|array',
            'productos.*.id_producto' => 'required|exists:producto,id', // Ajusta según el nombre de tu tabla de productos
            'productos.*.cantidad' => 'required|integer|min:1',
            'descuento' => 'nullable|integer|min:0|max:100',
            'subtotal' => 'required|string', // Para permitir el formato con comas/puntos
            'total' => 'required|string', // Para permitir el formato con comas/puntos
            'productos.*.precio_unitario' => 'required|string', // Validación del precio unitario
            'monto_pagado' => 'required|string', // Nuevo campo para registrar el monto pagado
            'tipo_pago_id' => 'required',  // Validar que el tipo de pago exista
        ]);

        // Limpiar los valores de subtotal y total eliminando puntos y comas
        $subtotalLimpiado = str_replace(['.', ','], ['', ''], $request->subtotal);
        $totalLimpiado = str_replace(['.', ','], ['', ''], $request->total);
        $montoPagado = (float)str_replace(['.', ','], ['', ''], $request->monto_pagado);

        // Convertir a valores numéricos
        $subtotal = (float) $subtotalLimpiado;
        $total = (float) $totalLimpiado;

        // Asignar un valor por defecto para el RUT si está vacío
        $rut_cliente = $request->rut_cliente ?: '11111111-1'; // Si el RUT es vacío o nulo, usar 11111111-1

        // Crear la venta
        $venta = new Venta();
        $venta->nombre_cliente = $request->nombre_cliente;
        $venta->rut_cliente = $rut_cliente; // Usar el RUT validado
        $venta->subtotal = $subtotal; // Usar el valor limpiado
        $venta->descuento = $request->descuento;
        $venta->nota = $request->nota;
        $venta->total = $total; // Usar el valor limpiado
        $venta->monto_pagado = $montoPagado;
        $venta->fecha_venta = now(); // O puedes usar Carbon::now()
        $venta->nombre_vendedor = "nombre vendedor";
        $venta->tipo_pago_id = $request->tipo_pago_id;

        //Descomentar al momento de poner el proyecto en producción
        //$venta->nombre_vendedor = $nombreUsuario;

        if ($montoPagado < $total) {
            $venta->estado_pago = 0; // No pagado completamente
        } else {
            $venta->estado_pago = 1; // Pagado completamente
        }

        $venta->save(); // Guardar la venta


        // Guardar los productos asociados
        foreach ($request->productos as $productoData) {

            // Limpiar el valor de precio_unitario
            $precioUnitarioLimpiado = str_replace(['.', ','], ['', ''], $productoData['precio_unitario']);

            // Convertir a valor numérico
            $precioUnitario = (float) $precioUnitarioLimpiado;

            $detalleVenta = new DetalleVenta();
            $detalleVenta->venta_id = $venta->id; // Asegúrate de que este es el campo correcto
            $detalleVenta->id_producto = $productoData['id_producto'];
            $detalleVenta->cantidad = $productoData['cantidad'];
            $detalleVenta->tipo_venta = $productoData['tipo_venta']; // Asumiendo que el tipo de venta se envía en el request
            $detalleVenta->id_presentacion = $productoData['id_presentacion']; // Asumiendo que el tipo de presentación se envía en el request
            $detalleVenta->precio_unitario = $precioUnitario;
            $detalleVenta->save(); // Guardar el detalle
        }

        // Si no se pagó el total, registrar una deuda
        if ($montoPagado < $total) {
            $deuda = new Deuda();
            $deuda->venta_id = $venta->id;
            $deuda->monto_adeudado = $total - $montoPagado;
            $deuda->save();
        }

        // Descontar el stock de los productos vendidos
        foreach ($request->productos as $productoData) {
            $producto = Producto::find($productoData['id_producto']);
            $tipoVenta = $productoData['tipo_venta'];
            $presentacion = $productoData['id_presentacion']; // Asumiendo que el tipo de presentación se envía en el request

            if ($producto) {
                if ($tipoVenta == 'completo') {
                    $producto->stock_unidades -= $productoData['cantidad'];
                } elseif ($tipoVenta == 'fraccionado') {
                    if ($presentacion == '1') {
                        $producto->stock_total_comprimidos -= $productoData['cantidad'];
                    } elseif ($presentacion == '2') {
                        $producto->stock_total_ml -= $productoData['cantidad'];
                    } elseif ($presentacion == '3') {
                        $producto->unidades_granel_total -= $productoData['cantidad'];
                    }
                }
                $producto->save();
            }
        }

        // Redireccionar o retornar respuesta
        return redirect()->route('ventas.index')->with('success', 'Venta generada exitosamente.');
    }

    public function destroy($venta)
    {
        $venta = Venta::find($venta);

        if ($venta === null) {
            return redirect()->route('ventas.index')->with('success', 'Venta no encontrada.');
        }

        // Verificar si la venta ya está anulada
        if ($venta->estado_pago == 2) {
            return redirect()->route('ventas.index')->with('success', 'La venta ya está anulada.');
        }

        // Obtener los detalles de la venta
        $detallesVenta = DetalleVenta::where('venta_id', $venta->id)->get();

        // Devolver el stock de los productos
        foreach ($detallesVenta as $detalle) {
            $producto = Producto::find($detalle->id_producto);
            $tipoVenta = $detalle->tipo_venta; // Asumiendo que el tipo de venta se guarda en el detalle venta
            $presentacion = $detalle->id_presentacion; // Asumiendo que el tipo de presentación se guarda en el detalle de la venta

            if ($producto) {
                if ($tipoVenta == 'completo') {
                    $producto->stock_unidades += $detalle->cantidad;
                } elseif ($tipoVenta == 'fraccionado') {
                    if ($presentacion == '1') {
                        $producto->stock_total_comprimidos += $detalle->cantidad;
                    } elseif ($presentacion == '2') {
                        $producto->stock_total_ml += $detalle->cantidad;
                    } elseif ($presentacion == '3') {
                        $producto->unidades_granel_total += $detalle->cantidad;
                    }
                }
                $producto->save();
            }
        }

        // Cambiar el estado de la venta a 'anulada' (2)
        $venta->estado_pago = 2;
        $venta->save(); // Guardar los cambios en la venta

        return redirect()->route('ventas.index')->with('success', 'Venta anulada correctamente y el stock ha sido devuelto.');
    }




public function show($id)
{
    $venta = Venta::find($id);

    if (!$venta) {
        return redirect()->route('ventas.index')->with('error', 'Venta no encontrada.');
    }

        // Obtener los detalles de la venta
        $detallesVenta = DetalleVenta::where('venta_id', $id)->get();

    // Formatear los valores numéricos

    $venta->subtotal = number_format( $venta->subtotal, 0, ',', '.');
    $venta->monto_pagado = number_format( $venta->monto_pagado, 0, ',', '.');

    return view('ventas.detalle', compact('venta', 'detallesVenta'));
}



 // Función para exportar a PDF
 public function exportPdf($id)
 {
     $venta = Venta::findOrFail($id);

     // Datos que pasarás a la vista para generar el PDF
     $data = [
         'venta' => $venta,
     ];

     $detallesVenta = DetalleVenta::where('venta_id', $id)->get();


     $data2 = [
         'detalle' => $detallesVenta,
     ];
     // Generar el PDF usando la vista del producto
     $pdf = Pdf::loadView('ventas.venta_recibo', $data, $data2);

     // Descargar el PDF con el nombre "producto.pdf"
     return $pdf->stream('venta.pdf');
 }

    
}
