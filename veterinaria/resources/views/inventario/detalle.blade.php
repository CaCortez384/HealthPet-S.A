<x-app-layout>
    <link href="{{ asset('css\detalle-producto-style.css') }}" rel="stylesheet">

    <div class="container">
        <div>
            <h1>Detalles del Producto</h1>
            
            <table>
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
                    <td>${{ $producto->precio_de_compra }}</td>
                </tr>
                <tr>
                    <th>Precio de Venta</th>
                    <td>${{ $producto->precio_de_venta }}</td>
                </tr>
                <tr>
                    <th>Stock</th>
                    <td>{{ $producto->stock_unidades }}</td>
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




                @if($producto->id_presentacion == 1)
                <tr>
                    <th>Cantidad de Comprimidos por Caja</th>
                    <td>{{ $producto->comprimidos_por_caja }}</td>
                </tr>
                <tr>
                    <th>Stock Total de Comprimidos</th>
                    <td>{{ $producto->stock_total_comprimidos }}</td>
                </tr>
                <tr>
                    <th>Valor de Venta por Comprimido</th>
                    <td>${{ $producto->precio_de_venta / $producto->comprimidos_por_caja }}</td>
                </tr>




                @elseif($producto->id_presentacion == 2)
                <tr>
                    <th>ML por unidad</th>
                    <td>{{ $producto->ml_por_unidad }} mL</td>
                </tr>
                <tr>
                    <th>Stock Total de ML</th>
                    <td>{{ $producto->stock_total_ml }} mL</td>
                </tr>
                <tr>
                    <th>Valor de Venta por ML</th>
                    <td>${{ $producto->precio_de_venta / $producto->ml_por_unidad }}</td>
                </tr>



                @elseif($producto->id_presentacion == 3)
                <tr>
                    <th>Cantidad de unidades por envase</th>
                    <td>{{ $producto->unidades_por_envase }}</td>
                </tr>
                <tr>
                    <th>Stock Total de unidades</th>
                    <td>{{ $producto->unidades_granel_total}} u</td>
                </tr>
                <tr>
                    <th>Valor de Venta por unidad</th>
                    <td>${{ $producto->precio_de_venta / $producto->unidades_por_envase }}</td>
                </tr>
                @endif


            </table>

            <a href="{{ route('listar.productos') }}" class="button">Volver a la lista</a>
        </div>
    </div>

</x-app-layout>    