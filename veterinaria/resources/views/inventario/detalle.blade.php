<x-app-layout>
    <link href="{{ asset('css\detalle-producto-style.css') }}" rel="stylesheet">

    <div class="container">
        <div>
            <h1>Detalles del Producto</h1>
            
            <table>
                <tr>
                    <th>ID</th>
                    <td>{{ $producto->id }}</td>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <td>{{ $producto->nombre }}</td>
                </tr>
                <tr>
                    <th>Código</th>
                    <td>{{ $producto->codigo }}</td>
                </tr>
                <tr>
                    <th>Precio de Compra</th>
                    <td>${{ number_format($producto->precio_de_compra, 2) }}</td>
                </tr>
                <tr>
                    <th>Precio de Venta</th>
                    <td>${{ number_format($producto->precio_de_venta, 2) }}</td>
                </tr>
                <tr>
                    <th>Stock</th>
                    <td>{{ $producto->stock }}</td>
                </tr>
                <tr>
                    <th>Fecha de Vencimiento</th>
                    <td>{{ $producto->fecha_de_vencimiento }}</td>
                </tr>
                <tr>
                    <th>Cantidad Mínima Requerida</th>
                    <td>{{ $producto->cantidad_minima_requerida }}</td>
                </tr>
                <tr>
                    <th>Fecha de Creación</th>
                    <td>{{ $producto->created_at }}</td>
                </tr>
                <tr>
                    <th>Última Actualización</th>
                    <td>{{ $producto->updated_at }}</td>
                </tr>
            </table>

            <a href="{{ route('listar.productos') }}" class="button">Volver a la lista</a>
        </div>
    </div>

</x-app-layout>    