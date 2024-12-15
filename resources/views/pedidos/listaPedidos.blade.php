<x-app-layout>

    <div>
        @include('components.alert')
        @section('content')
            @include('components.alert')
        @endsection

        <div id="contenedor_buscar">
            <h6>Buscar pedidos</h6>
            <div id="menu-busqueda">
                <form action="{{ route('pedidos.index') }}" method="GET">
                    <div class="todo_input-busqueda">
                        <md-filled-text-field class="input-busqueda" label="Numero de pedido"
                            name="numero_pedido"></md-filled-text-field>
                        <md-filled-select class="input-busqueda" label="Estado de pedido" name="estado_pedido">
                            <md-select-option value="" selected>Selecciona una opción</md-select-option>
                            <md-select-option value="1">Pendiente</md-select-option>
                            <md-select-option value="2">Pedido realizado</md-select-option>
                            <md-select-option value="3">Listo para entrega</md-select-option>
                            <md-select-option value="4">Entregado</md-select-option>
                            <md-select-option value="5">Cancelado</md-select-option>
                        </md-filled-select>
                    </div>
                    <div id="botones_busqueda">
                        <a class="buscar-botons" href="{{ route('pedidos.index') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <md-fab label="Buscar">
                                <md-icon slot="icon">search</md-icon>
                            </md-fab>
                        </a>
                        <a class="buscar-botons"
                            href="{{ route('pedidos.index', array_filter(request()->except(['numero_pedido', 'estado_pedido']))) }}">
                            <md-fab label="Eliminar filtro">
                                <md-icon slot="icon">delete</md-icon>
                            </md-fab>
                        </a>
                    </div>
                </form>
            </div>
            @if ($filtros['Numero_pedido'] || isset($filtros['Estado_pedido']))
                <div class="filtros-activos">
                    <h5>Filtros Aplicados:</h5>
                    <md-chip-set>
                        @if (!empty($filtros['Numero_pedido']))
                            <md-assist-chip>Nro pedido: "{{ $filtros['Numero_pedido'] }}"
                                <md-icon slot="icon">barcode</md-icon>
                            </md-assist-chip>
                        @endif
                        @if (isset($filtros['Estado_pedido']))
                            <md-assist-chip>
                                Estado de pedido:
                                @switch($filtros['Estado_pedido'])
                                    @case(1)
                                        Pendiente
                                    @break

                                    @case(2)
                                        Pedido realizado
                                    @break

                                    @case(3)
                                        Listo para entrega
                                    @break

                                    @case(4)
                                        Entregado
                                    @break

                                    @case(5)
                                        Cancelado
                                    @break

                                    @default
                                        Desconocido
                                @endswitch
                                <md-icon slot="icon">assignment_turned_in</md-icon>
                            </md-assist-chip>
                        @endif
                    </md-chip-set>
                </div>
            @endif
        </div>
        <br>
        <div class="accordion" id="ordersAccordion">
            @forelse ($pedidos as $pedido)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="order{{ $pedido->id }}">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOrder{{ $pedido->id }}" aria-expanded="true"
                            aria-controls="collapseOrder{{ $pedido->id }}">
                            <div class="row w-100">
                                <div class="col-md-2"><strong>N°:</strong> {{ $pedido->id }}</div>
                                <div class="col-md-2"><strong>Fecha:</strong> {{ $pedido->created_at->format('Y-m-d') }}
                                </div>
                                <div class="col-md-2"><strong>Items:</strong>
                                    {{ $pedido->detallePedidos->sum('cantidad') }}</div>
                                <div class="col-md-3"><strong>Total:</strong>
                                    ${{ number_format($pedido->total, 0, ',', '.') }}</div>
                                <div class="col-md-3"><strong>Monto pagado:</strong>
                                    ${{ number_format($pedido->monto_pagado, 0, ',', '.') }}</div>
                                <div class="col-md-3"><strong>Estado:</strong>
                                    @switch($pedido->estado_pedido)
                                        @case(1)
                                            Pendiente
                                        @break

                                        @case(2)
                                            En proceso
                                        @break

                                        @case(3)
                                            Listo para entrega
                                        @break

                                        @case(4)
                                            Entregado
                                        @break

                                        @default
                                            Cancelado
                                    @endswitch
                                </div>
                            </div>
                        </button>
                    </h2>
                    <div id="collapseOrder{{ $pedido->id }}" class="accordion-collapse collapse"
                        aria-labelledby="order{{ $pedido->id }}" data-bs-parent="#ordersAccordion">
                        <div class="accordion-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Item</th>
                                        <th>Cantidad</th>
                                        <th>Precio Unitario</th>
                                        <th>Subtotal</th>
                                        <th>Monto Pagado</th>
                                        <th>Disponible</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pedido->detallePedidos as $detalle)
                                        <tr>
                                            <td>{{ $detalle->producto->nombre }}</td>
                                            <td>{{ $detalle->cantidad }}</td>
                                            <td>${{ number_format($detalle->precio, 0, ',', '.') }}</td>
                                            <td>${{ number_format($detalle->cantidad * $detalle->precio, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                @if ($detalle->descuento == 0)
                                                    Completo
                                                @else
                                                    ${{ number_format($detalle->descuento, 0, ',', '.') }}
                                                @endif
                                            </td>
                                            <td>
                                                <input type="checkbox" {{ $detalle->descuento == 0 ? 'checked' : '' }}>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <form action="{{ route('pedidos.update', $pedido->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="btn-group" role="group" aria-label="Estado del Pedido">
                                    <button type="button"
                                        class="btn btn-outline-primary {{ $pedido->estado_pedido == 1 ? 'active' : '' }}"
                                        data-value="1">Pendiente</button>
                                    <button type="button"
                                        class="btn btn-outline-secondary {{ $pedido->estado_pedido == 2 ? 'active' : '' }}"
                                        data-value="2">En proceso</button>
                                    <button type="button"
                                        class="btn btn-outline-success {{ $pedido->estado_pedido == 3 ? 'active' : '' }}"
                                        data-value="3">Listo para retiro</button>
                                    <button type="button"
                                        class="btn btn-outline-info {{ $pedido->estado_pedido == 4 ? 'active' : '' }}"
                                        data-value="4">Entregado</button>
                                    <button type="button"
                                        class="btn btn-outline-danger {{ $pedido->estado_pedido == 5 ? 'active' : '' }}"
                                        data-value="5">Cancelado</button>
                                </div>
                                <input type="hidden" name="estado_pedido" id="estado_pedido"
                                    value="{{ $pedido->estado_pedido }}">
                                <div>
                                    <button type="submit" class="btn btn-primary mt-2">Cambiar estado</button>
                                </div>
                            </form>


                            <br>
                            <a href="{{ route('pedidos.show', ['id' => $pedido->id]) }}">
                                <md-fab size="small" aria-label="Ver Detalles">
                                    <md-icon slot="icon">visibility</md-icon>
                                </md-fab>
                            </a>
                        </div>
                    </div>

                </div>
                @empty
                    <p>No se encontraron pedidos con los filtros aplicados.</p>
                @endforelse
            </div>

            <div class="pagination">
                {{ $pedidos->links() }}
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const accordions = document.querySelectorAll('.accordion-item');

                accordions.forEach(accordion => {
                    const buttons = accordion.querySelectorAll('.btn-group .btn');
                    const estadoPedidoInput = accordion.querySelector('input[name="estado_pedido"]');

                    buttons.forEach(button => {
                        button.addEventListener('click', function() {
                            // Remueve la clase 'active' de todos los botones
                            buttons.forEach(btn => btn.classList.remove('active'));
                            // Agrega la clase 'active' solo al botón clicado
                            this.classList.add('active');
                            // Actualiza el valor del input
                            estadoPedidoInput.value = this.getAttribute('data-value');
                        });
                    });
                });
            });
        </script>

    </x-app-layout>
