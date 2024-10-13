<x-app-layout>


    <div>
        @include('components.alert')
        {{-- alerta que muestra cuando una venta se creo con éxito --}}
        @section('content')
            @include('components.alert')
        @endsection


        <div id="contenedor">

            <div>
                <h6>Buscar ventas</h6>
            </div>
            {{-- Formulario para búsqueda de ventas mediante rut de cliente o si posee deuda --}}
            <div id="menu-busqueda">
                <form action="{{ route('ventas.index') }}" method="GET">
                    <div id="inputs-busqueda">
                        <md-filled-text-field class="input-busqueda" label="Rut del cliente" name="rut">
                        </md-filled-text-field>

                        <md-filled-select class="input-busqueda" label="Estado de Venta" name="deuda">
                            <md-select-option value="" selected>Selecciona una opción</md-select-option>

                            <md-select-option value=0>
                                Registra deuda
                            </md-select-option>
                            <md-select-option value=1>
                                Completa
                            </md-select-option>
                            <md-select-option value=2>
                                Anulada
                            </md-select-option>

                        </md-filled-select>

                        {{-- Botón para buscar una venta --}}
                        <a class="buscar-botons" href="{{ route('ventas.index') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <md-fab label="Buscar">
                                <md-icon slot="icon">search</md-icon>
                            </md-fab>
                        </a>

                        {{-- Botón para limpiar el filtro aplicado --}}
                        <a class="buscar-botons" href="{{ route('ventas.index') }}">
                            <md-fab label="Eliminar filtro">
                                <md-icon slot="icon">delete</md-icon>
                            </md-fab>
                        </a>

                    </div>
                </form>
            </div>



            {{-- en esta sección se muestran los filtros aplicados anteriormente --}}
            @if ($filtros['rut'] || $filtros['deuda'])
                <div class="filtros-activos">
                    <h5>Filtros Aplicados:</h5>
                    <md-chip-set>
                        @if ($filtros['rut'])
                            <md-assist-chip>Rut: "{{ $filtros['rut'] }}"
                                <md-icon slot="icon">person</md-icon>
                            </md-assist-chip>
                        @endif
                        @if ($filtros['deuda'])
                            <md-assist-chip>Deuda: "{{ $filtros['deuda'] }}"
                                <md-icon slot="icon">badge</md-icon>
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
                            <td></td>
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
                                        ¿Está seguro que desea anular la venta?
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
