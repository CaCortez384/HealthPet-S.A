<x-app-layout>


    <div>
        @include('components.alert')
        {{-- alerta que muestra cuando una deuda se creo con éxito --}}
        @section('content')
            @include('components.alert')
        @endsection


        <div id="contenedor_buscar">

            <div>
                <h6>Buscar Deuda</h6>
            </div>
            {{-- Formulario para búsqueda de deudas mediante rut de cliente o si posee deuda --}}
            <div id="menu-busqueda">
                <form action="{{ route('deudas.index') }}" method="GET">
                    <div class="todo_input-busqueda" style="display: flex; gap: 1rem; align-items: center;">

                        <div>
                            <md-filled-text-field class="input-busqueda" label="Rut del cliente" name="rut">
                            </md-filled-text-field>
                        </div>

                        <div id="rango_fechas" style="display: flex; width: 70%">
                            <!-- Campo de fecha inicio -->
                            <md-filled-text-field class="input-busqueda" label="Fecha Inicio (dd-mm-yyyy)"
                                name="fecha_inicio" type="date">
                            </md-filled-text-field>

                            <!-- Campo de fecha fin -->
                            <md-filled-text-field class="input-busqueda" label="Fecha Fin (dd-mm-yyyy)" name="fecha_fin"
                                type="date">
                            </md-filled-text-field>
                        </div>
                        <div id="botones_busqueda">
                            <!-- Botón para buscar -->
                            <a class="buscar-botons" href="{{ route('deudas.index') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                <md-fab label="Buscar">
                                    <md-icon slot="icon">search</md-icon>
                                </md-fab>
                            </a>
                            {{-- Botón para limpiar el filtro de fecha y RUT --}}
                            <a class="buscar-botons"
                                href="{{ route('deudas.index', array_filter(request()->except(['rut', 'fecha_inicio', 'fecha_fin']))) }}">
                                <md-fab label="Eliminar filtro">
                                    <md-icon slot="icon">delete</md-icon>
                                </md-fab>
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            @if ($filtros['fecha_inicio'] && $filtros['fecha_fin']))
                <div class="filtros-activos">
                    <h5>Filtros Aplicados:</h5>
                    <md-chip-set>
                        @if (!empty($filtros['rut']))
                            <md-assist-chip>Rut: "{{ $filtros['rut'] }}"
                                <md-icon slot="icon">person</md-icon>
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



            <!-- Tabla para listar deudas -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Fecha de deuda</th>
                        <th scope="col">Rut cliente</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Total adeudado</th>
                        <th scope="col">Total de venta</th>
                        <th scope="col">Estado de deuda</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- recorrer todas las deudas --}}
                    @forelse ($deudas as $deuda)
                        <tr>
                            <td>{{ $deuda->created_at->format('d/m/Y') }}</td>
                            <td>{{ number_format(substr($deuda->venta->rut_cliente, 0, -1), 0, '', '.') . '-' . substr($deuda->venta->rut_cliente, -1) }}
                            </td>
                            <td>{{ $deuda->venta->nombre_cliente }}</td>
                            <td>{{ '$' . number_format($deuda->monto_adeudado, 0, ',', '.') }}</td>
                            <td>{{ '$' . number_format($deuda->venta->total, 0, ',', '.') }}</td>
                            <td>
                                @switch($deuda->estado)
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
                                <a href="{{ route('deuda.detalle', ['id' => $deuda->id]) }}">
                                    <md-fab size="small" aria-label="View">
                                        <md-icon slot="icon">visibility</md-icon>
                                    </md-fab>
                                </a>

                                {{-- Mostrar el botón de anular solo si la venta no está anulada --}}
                                <a id="openDialogButton_{{ $deuda->id }}"
                                    @if ($deuda->estado === 2) style="display:none;" @endif>
                                    <md-fab class="boton-tabla" size="small" aria-label="Delete">
                                        <md-icon slot="icon">delete</md-icon>
                                    </md-fab>
                                </a>
                                <!-- Diálogo alerta para eliminar deuda -->
                                <md-dialog id="dialog_{{ $deuda->id }}">
                                    <div slot="headline">
                                        Anular deuda "{{ $deuda->id }}"
                                    </div>
                                    <form slot="content" action="{{ route('deuda.eliminar', ['id' => $deuda->id]) }}"
                                        id="form-id-{{ $deuda->id }}" method="POST">
                                        @csrf
                                        Una vez que la deuda haya sido anulada, no será posible revertir los cambios
                                        realizados.
                                        ¿Está seguro que desea Anular la deuda?
                                    </form>
                                    <div slot="actions">
                                        <md-text-button id="closeButton_{{ $deuda->id }}">Cancelar</md-text-button>

                                        {{-- Botón para confirmar la eliminación de la deuda --}}
                                        <md-text-button type="submit"
                                            form="form-id-{{ $deuda->id }}">Anular</md-text-button>
                                    </div>
                                </md-dialog>
                            </td>
                        </tr>

                        @empty
                            <tr>
                                <td colspan="5">No se encontraron deudas con los filtros aplicados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Enlaces de paginación --}}
                <div class="pagination">
                    {{ $deudas->links() }} <!-- Agrega enlaces de paginación aquí -->
                </div>

            </div>

            <script>
                document.addEventListener('DOMContentLoaded', () => {
                    @foreach ($deudas as $deuda)
                        // Obtener el botón y el diálogo con el id específico de la deuda
                        const openDialogButton_{{ $deuda->id }} = document.getElementById(
                            'openDialogButton_{{ $deuda->id }}');
                        const dialog_{{ $deuda->id }} = document.getElementById('dialog_{{ $deuda->id }}');
                        const closeButton_{{ $deuda->id }} = document.getElementById(
                            'closeButton_{{ $deuda->id }}');

                        // Añadir el evento para abrir el diálogo
                        openDialogButton_{{ $deuda->id }}.addEventListener('click', async () => {
                            await dialog_{{ $deuda->id }}.show(); // Abre el diálogo correspondiente
                        });

                        // Añadir el evento para cerrar el diálogo
                        closeButton_{{ $deuda->id }}.addEventListener('click', async () => {
                            await dialog_{{ $deuda->id }}.close(); // Cierra el diálogo correspondiente
                        });
                    @endforeach
                });
            </script>

        </div>
    </x-app-layout>
