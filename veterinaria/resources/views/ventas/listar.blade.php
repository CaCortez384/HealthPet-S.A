<x-app-layout>


    <div>
        @include('components.alert')
        {{-- alerta que muestra cuando una venta se creo con éxito --}}
        @section('content')
            @include('components.alert')
        @endsection


        <div id="contenedor_buscar">

            <div>
                <h6>Buscar ventas</h6>
            </div>
            {{-- Formulario para búsqueda de ventas mediante rut de cliente o si posee deuda --}}
            <div id="menu-busqueda">
                <form action="{{ route('ventas.index') }}" method="GET">
                    <div class="todo_input-busqueda">

                        <div>
                            <md-filled-text-field class="input-busqueda" label="Rut del cliente" name="rut">
                            </md-filled-text-field>
                        </div>

                        <div>
                            <md-filled-select class="input-busqueda" label="Estado de Venta" name="deuda">
                                <md-select-option value="" selected>Selecciona una opción</md-select-option>
                                <md-select-option value="0">Registra deuda</md-select-option>
                                <md-select-option value="1">Completa</md-select-option>
                                <md-select-option value="2">Anulada</md-select-option>

                            </md-filled-select>
                        </div>


                        <div id="rango_fechas">
                            <h6>Seleccione un rango de fechas</h6>
                            <!-- Campo de fecha inicio -->
                            <md-filled-text-field class="input-busqueda" label="Fecha Inicio (dd-mm-yyyy)"
                                name="fecha_inicio" type="date">
                            </md-filled-text-field>

                            <!-- Campo de fecha fin -->
                            <md-filled-text-field class="input-busqueda" label="Fecha Fin (dd-mm-yyyy)" name="fecha_fin"
                                type="date">
                            </md-filled-text-field>
                        </div>
                    </div>

                    <div id="botones_busqueda">
                        <!-- Botón para buscar -->
                        <a class="buscar-botons" href="{{ route('ventas.index') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <md-fab label="Buscar">
                                <md-icon slot="icon">search</md-icon>
                            </md-fab>
                        </a>



                        {{-- Botón para limpiar el filtro de fecha y RUT --}}
                        <a class="buscar-botons"
                            href="{{ route('ventas.index', array_filter(request()->except(['rut', 'deuda', 'fecha_inicio', 'fecha_fin']))) }}">
                            <md-fab label="Eliminar filtro">
                                <md-icon slot="icon">delete</md-icon>
                            </md-fab>
                        </a>

                    </div>



                </form>
            </div>



            @if ($filtros['rut'] || isset($filtros['deuda']) || ($filtros['fecha_inicio'] && $filtros['fecha_fin']))
                <div class="filtros-activos">
                    <h5>Filtros Aplicados:</h5>
                    <md-chip-set>
                        @if (!empty($filtros['rut']))
                            <md-assist-chip>Rut: "{{ $filtros['rut'] }}"
                                <md-icon slot="icon">person</md-icon>
                            </md-assist-chip>
                        @endif
                        @if (isset($filtros['deuda']))
                            {{-- Cambiado a isset --}}
                            <md-assist-chip>Deuda: "{{ $filtros['deuda'] }}"
                                <md-icon slot="icon">badge</md-icon>
                            </md-assist-chip>
                        @endif
                        @if (!empty($filtros['fecha_inicio']) && !empty($filtros['fecha_fin']))
                            <md-assist-chip>
                                Fecha: Desde "{{ $filtros['fecha_inicio'] }}" Hasta "{{ $filtros['fecha_fin'] }}"
                                <md-icon slot="icon">calendar_today</md-icon>
                            </md-assist-chip>
                        @endif
                    </md-chip-set>
                </div>
            @endif
        </div>

        <div id="contenedor">

            <div id="lista-usuarios">
                <h6>Listado de ventas</h6>
                {{-- Botón para agregar una nueva venta --}}
                <a href="{{ route('ventas.create') }}">
                    <md-fab label="Registrar Nueva venta">
                        <md-icon slot="icon">add</md-icon>
                    </md-fab>
                </a>
            </div>

            <!-- Tabla para listar ventas -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID Venta</th>
                        <th scope="col">Fecha de venta</th>
                        <th scope="col">Vendedor</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Total</th>
                        <th scope="col">Tipo de pago</th>
                        <th scope="col">Estado de Venta</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- recorrer todas las ventas --}}
                    @forelse ($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id }}</td>
                            <td>{{ $venta->fecha_venta->format('d/m/Y') }}</td>
                            <td>{{ $venta->nombre_vendedor }}</td>
                            <td>{{ $venta->nombre_cliente }}</td>
                            <td>{{ $venta->total }}</td>
                            <td>{{ $venta->tipoPago->nombre }}</td>
                            <td>
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
                            </td>
                            <td>
                                <a href="{{ route('ventas.show', ['id' => $venta->id]) }}">
                                    <md-fab size="small" aria-label="View">
                                        <md-icon slot="icon">visibility</md-icon>
                                    </md-fab>
                                </a>

                                <!-- Botón para diálogo alerta eliminar -->
                                <a id="openDialogButton_{{ $venta->id }}">
                                    <md-fab class="boton-tabla" size="small" aria-label="Delete">
                                        <md-icon slot="icon">delete</md-icon>
                                    </md-fab>
                                </a>
                                <!-- Diálogo alerta para eliminar venta -->
                                <md-dialog id="dialog_{{ $venta->id }}">
                                    <div slot="headline">
                                        Anular Venta "{{ $venta->id }}"
                                    </div>
                                    <form slot="content" action="{{ route('ventas.destroy', $venta->id) }}"
                                        id="form-id-{{ $venta->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        Una vez que la venta haya sido anulada, no será posible revertir los cambios
                                        realizados.
                                        ¿Está seguro que desea Anular la venta?
                                    </form>
                                    <div slot="actions">
                                        <md-text-button id="closeButton_{{ $venta->id }}">Cancelar</md-text-button>

                                        {{-- Botón para confirmar la eliminación de la venta --}}
                                        <md-text-button type="submit"
                                            form="form-id-{{ $venta->id }}">Anular</md-text-button>
                                    </div>
                                </md-dialog>
                            </td>
                        </tr>

                        @empty
                            <tr>
                                <td colspan="5">No se encontraron ventas con los filtros aplicados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Enlaces de paginación --}}
                <div class="pagination">
                    {{ $ventas->links() }} <!-- Agrega enlaces de paginación aquí -->
                </div>

            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    @foreach ($ventas as $venta)
                        // Obtener el botón y el diálogo con el id específico de la venta
                        const openDialogButton_{{ $venta->id }} = document.getElementById(
                            'openDialogButton_{{ $venta->id }}');
                        const dialog_{{ $venta->id }} = document.getElementById('dialog_{{ $venta->id }}');
                        const closeButton_{{ $venta->id }} = document.getElementById(
                            'closeButton_{{ $venta->id }}');

                        // Añadir el evento para abrir el diálogo
                        openDialogButton_{{ $venta->id }}.addEventListener('click', async () => {
                            await dialog_{{ $venta->id }}.show(); // Abre el diálogo correspondiente
                        });

                        // Añadir el evento para cerrar el diálogo
                        closeButton_{{ $venta->id }}.addEventListener('click', async () => {
                            await dialog_{{ $venta->id }}.close(); // Cierra el diálogo correspondiente
                        });
                    @endforeach
                });
            </script>

        </div>
    </x-app-layout>
