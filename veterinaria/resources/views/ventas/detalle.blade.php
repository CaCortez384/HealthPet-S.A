<x-app-layout>
    <div class="container">
        <h1>Detalle de la Venta #{{ $venta->id }}</h1>
        
        <h4>Información de la venta</h4>
        <p><strong>Cliente:</strong> {{ $venta->nombre_cliente }}</p>
        <p><strong>RUT Cliente:</strong> {{ $venta->rut_cliente ?? '11111111-1' }}</p>
        <p><strong>Fecha de Venta:</strong> {{ $venta->fecha_venta }}</p>
        <p><strong>Subtotal:</strong> {{ $venta->subtotal}} CLP</p>
        <p><strong>Descuento:</strong> {{ $venta->descuento }}%</p>
        <p><strong>Total:</strong> {{$venta->total}} CLP</p>
        <p><strong>Monto Pagado:</strong> {{ $venta->monto_pagado}} CLP</p>
        <p><strong>Estado de Pago:</strong>
            @switch($venta->estado_pago)
                @case(0)
                    Registra deuda
                    @break
                @case(1)
                    Completa
                    @break
                @case(2)
                    Anulada
                    @break
                @default
                    Desconocido
            @endswitch
        </p>
        
        <h4>Productos en la venta</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detallesVenta as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ number_format($detalle->precio_unitario, 0, ',', '.') }} CLP</td>
                        <td>{{ number_format($detalle->precio_unitario * $detalle->cantidad, 0, ',', '.') }} CLP</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('ventas.index') }}" class="btn btn-primary">Volver a la lista de ventas</a>
    </div>

</x-app-layout>