<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use App\Models\Venta;
use App\Models\Deuda;
use Carbon\Carbon;

class HomeController extends Controller
{
    // Constante para los estados del pedido
    const ESTADOS_PEDIDO = [
        1 => 'Pendiente',
        2 => 'En tránsito',
        3 => 'Listo para retiro',
        4 => 'Entregado',
    ];

    public function inicio()
    {
        // Obtener productos con stock por debajo del mínimo requerido
        $productosBajoStock = Producto::whereColumn('stock_unidades', '<', 'cantidad_minima_requerida')->get();

        // Renderizar vista con los datos
        return view('components.app-layout', [
            'productosBajoStock' => $productosBajoStock,
        ]);
    }

    public function index()
    {
        // Datos básicos del dashboard
        $productosBajoStock = Producto::whereColumn('stock_unidades', '<', 'cantidad_minima_requerida')->get();
        $nuevosPedidos = Pedido::whereDate('created_at', Carbon::today())->count();
        $pedidosActivos = Pedido::whereIn('estado_pedido', [1, 2, 3])->count();
        $ingresosHoy = Venta::whereDate('fecha_venta', Carbon::today())->sum('monto_pagado');
        $ventas = Venta::whereDate('fecha_venta', Carbon::today())->count();
        $deudoresActuales = Deuda::where('estado', 0)->count();
        $promedioVentasDiario = Venta::avg('monto_pagado') ?? 0; // Asegura que no sea null

        // Día con más ventas
        $diasConMasVentas = Venta::selectRaw('DATE(created_at) as fecha, COUNT(*) as total')
            ->groupBy('fecha')
            ->orderBy('total', 'desc')
            ->first();


        // Renderizar vista con los datos
        return view('home', [
            'productosBajoStock' => $productosBajoStock,
            'nuevosPedidos' => $nuevosPedidos,
            'pedidosActivos' => $pedidosActivos,
            'ingresosHoy' => $ingresosHoy,
            'ventas' => $ventas,
            'deudoresActuales' => $deudoresActuales,
            'promedioVentasDiario' => $promedioVentasDiario,
            'diasConMasVentas' => $diasConMasVentas->fecha ?? 'N/A',
            'estadosPedido' => self::ESTADOS_PEDIDO,

        ]);
    }

    public function getSalesData($tipo = 'mes') // 'mes' por defecto
    {
        if ($tipo == 'dia') {
            // Obtener ventas diarias
            $ventasPorDia = Venta::selectRaw('DATE(fecha_venta) as dia, SUM(total) as total')
                ->groupBy('dia')
                ->orderBy('dia', 'asc')
                ->get();

            // Transformar datos para el gráfico
            $labels = $ventasPorDia->map(fn($venta) => $venta->dia);
            $data = $ventasPorDia->pluck('total');
        } else {
            // Obtener ventas mensuales
            $ventasPorMes = Venta::selectRaw('MONTH(fecha_venta) as mes, YEAR(fecha_venta) as anio, SUM(total) as total')
                ->groupBy('anio', 'mes')
                ->orderBy('anio', 'asc')
                ->orderBy('mes', 'asc')
                ->get();

            // Transformar datos para el gráfico
            $labels = $ventasPorMes->map(fn($venta) => $venta->anio . '-' . str_pad($venta->mes, 2, '0', STR_PAD_LEFT));
            $data = $ventasPorMes->pluck('total');
        }

        // Retornar datos al cliente
        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
    }




    public function nose()
    {
        // Renderizar vista de bienvenida
        return view('welcome');
    }
}
