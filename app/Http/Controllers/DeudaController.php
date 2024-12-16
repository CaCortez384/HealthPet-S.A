<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Deuda;
use App\Models\TipoPago;
use App\Models\Pago;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class DeudaController extends Controller
{
    function listarDeudas()
    {
        $filtros = [
            'rut' => request('rut'),
            'fecha_inicio' => request('fecha_inicio'),
            'fecha_fin' => request('fecha_fin'),
        ];
        $ventas = Venta::query();
        $deudas = Deuda::query()
            ->join('ventas', 'deudas.venta_id', '=', 'ventas.id')
            ->select('deudas.*', 'ventas.rut_cliente'); // Selecciona las columnas necesarias
    
        if (!empty($filtros['rut'])) {
            $ventas = Venta::where('rut_cliente', 'like', '%' . $filtros['rut'] . '%')->pluck('id');
            $deudas->whereIn('venta_id', $ventas); // Cambiar id_venta por venta_id
        }
    
        // Filtrado por rango de fechas
        if (!empty($filtros['fecha_inicio']) && !empty($filtros['fecha_fin'])) {
            // Convertir las fechas al formato Y-m-d
            $fechaInicio = Carbon::createFromFormat('Y-m-d', $filtros['fecha_inicio'])->startOfDay();
            $fechaFin = Carbon::createFromFormat('Y-m-d', $filtros['fecha_fin'])->endOfDay();
    
            $deudas->whereBetween('deudas.created_at', [$fechaInicio, $fechaFin]);
        }
    
        $deudas = $deudas->paginate(10);
    
        return view('deudas.listar', compact('deudas', 'filtros', 'ventas'));
    }

    function detalleDeuda($id)
    {
        $deuda = Deuda::find($id);
        $tipoPago1 = TipoPago::all();
        if (!$deuda) {
            return redirect()->back()->with('error', 'Deuda no encontrada');
        }
        $pagos = Pago::where('deuda_id', $id)->get();
        $venta = Venta::find($deuda->venta_id);
        $detalleVenta = DetalleVenta::where('venta_id', $deuda->venta_id)->get();
        $tipoPago = TipoPago::find($deuda->tipo_pago_id);

        return view('deudas.detalle', compact('deuda', 'venta', 'detalleVenta', 'tipoPago', 'pagos', 'tipoPago1'));
    }


    public function storePago(Request $request)
    {
        $request->validate([
            'deuda_id' => 'required|exists:deudas,id',
            'monto_pagado' => 'required|numeric|min:0',
            'tipo_pago_id' => 'required|exists:tipo_pago,id',
        ]);

        $deuda = Deuda::findOrFail($request->deuda_id);
        $montoRestante = $deuda->monto_adeudado - $request->monto_pagado;

        $pago = new Pago();
        $pago->deuda_id = $deuda->id;
        $pago->monto_pagado = str_replace('.', '', $request->monto_pagado);
        $pago->monto_restante = $montoRestante;
        $pago->tipo_pago_id = $request->tipo_pago_id;
        $pago->save();

        $deuda->monto_adeudado = $montoRestante;
        $deuda->estado = $montoRestante <= 0 ? 1 : 0; // 1 = Pagado, 0 = Pendiente
        $deuda->save();

        // Actualizar el estado_pago en la tabla ventas
        $venta = Venta::findOrFail($deuda->venta_id);
        $venta->estado_pago = $deuda->estado;
        $venta->save();

        

        return redirect()->route('deuda.detalle', $deuda->id)->with('success', 'Pago realizado con éxito');
    }

    public function destroy($id)
    {
        $deuda = Deuda::find($id);
        if (!$deuda) {
            return redirect()->back()->with('error', 'Deuda no encontrada');
        }
        $deuda->estado = 2; // 2 = Anulada
        $deuda->monto_adeudado = 0; // Monto adeudado pasa a 0
        $deuda->save();
        return redirect()->route('deudas.index')->with('success', 'Deuda anulada con éxito');
    }
}
