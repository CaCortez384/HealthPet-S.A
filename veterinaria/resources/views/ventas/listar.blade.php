<x-app-layout>
    <div class="container">
        <h1>Listado de Ventas</h1>

        <div><button>nueva venta</button></div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID Venta</th>
                    <th>Fecha de Venta</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->fecha_venta }}</td>
                        <td>{{ $venta->nombre_vendedor }}</td>
                        <td>{{ $venta->nombre_cliente }}</td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                        <td>
                            <div><button>ver detalle</button></div>
                            <div><button>eliminar</button></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>