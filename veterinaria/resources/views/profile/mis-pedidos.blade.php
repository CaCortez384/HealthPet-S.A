<x-home>
    <x-menu-user>
        <div class="container mt-5">
            <!-- Título y descripción -->
            <h1 class="mb-3">Mis Pedidos</h1>
            <p class="text-muted">Aquí encontrarás un historial de todos tus pedidos. Puedes buscar por el número de
                pedido o filtrar por el estado del pedido (Completado o Pendiente).</p>
            <!-- Filtro de búsqueda -->
            <div id="contenedor_buscar">
                <h6>Buscar pedidos</h6>
                <div id="menu-busqueda">
                    <form action="{{ route('profile.pedidos') }}" method="GET">
                        <div class="row mb-4">
                            <!-- Campo de búsqueda por Número de Pedido -->
                            <div class="col-md-4">
                                <input type="text" class="form-control" placeholder="Buscar por N° de pedido"
                                    name="numero_pedido">
                            </div>

                            <!-- Select de Estado de Pedido -->
                            <div class="col-md-4">
                                <select class="form-select" name="estado_pedido">
                                    <option value="">Filtrar por Estado</option>
                                    <option value="completado">Completado</option>
                                    <option value="pendiente">Pendiente</option>
                                </select>
                            </div>

                            <!-- Botón Aplicar Filtro -->
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary w-100">Aplicar Filtro</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Filtros activos y botón de eliminar filtro -->
                @if ($filtros['Numero_pedido'] || isset($filtros['Estado_pedido']))
                    <div class="d-flex justify-content-between align-items-center mt-3 filtros-activos">
                        <div class="chip-set">
                            <h5>Filtros Aplicados:</h5>
                            @if (!empty($filtros['Numero_pedido']))
                                <div class="chip">
                                    Nro pedido: "{{ $filtros['Numero_pedido'] }}"
                                    <i class="material-icons">barcode</i>
                                </div>
                            @endif
                            @if (isset($filtros['Estado_pedido']))
                                <div class="chip">
                                    Estado de pedido:
                                    @switch($filtros['Estado_pedido'])
                                        @case('completado')
                                            Completado
                                        @break

                                        @case('pendiente')
                                            Pendiente
                                        @break

                                        @default
                                            Desconocido
                                    @endswitch
                                    <i class="material-icons">assignment_turned_in</i>
                                </div>
                            @endif
                        </div>

                        <!-- Botón Eliminar filtro a la derecha -->
                        <a href="{{ route('profile.pedidos', array_filter(request()->except(['numero_pedido', 'estado_pedido']))) }}"
                            class="btn btn-secondary">
                            Eliminar filtro
                        </a>
                    </div>
                @endif
            </div>


            <hr>

            <!-- Tabla de pedidos -->
            <div class="accordion" id="ordersAccordion">
                @forelse ($pedidos as $pedido)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="order{{ $pedido->id }}">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOrder{{ $pedido->id }}" aria-expanded="true"
                                aria-controls="collapseOrder{{ $pedido->id }}">
                                <div class="row w-100">
                                    <div class="col-md-2"><strong>N°:</strong> {{ $pedido->id }}</div>
                                    <div class="col-md-2"><strong>Fecha:</strong>
                                        {{ $pedido->created_at->format('Y-m-d') }}
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
                                                    <input type="checkbox"
                                                        {{ $detalle->descuento == 0 ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <form action="" method="POST">
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
                                </form>
                                <br>
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
            </div>




        </x-menu-user>
    </x-home>
