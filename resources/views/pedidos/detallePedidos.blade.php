<x-app-layout>

    <link href="{{ asset('css\ventas\detalle-venta-style.css') }}" rel="stylesheet">

    <div class="contenedor">
        <div class="top-container">
            <div class="product-details-container">
                <div id="volver-titulo">
                    <a href="{{ route('pedidos.index') }}">
                        <md-icon-button id="openDialogButton">
                            <md-icon>arrow_back</md-icon>
                        </md-icon-button>
                    </a>
                </div>
                <!-- Encabezado: Nombre del producto y botones -->

                <div class="header2">
                    <div class="product-name">
                        <h2>Detalle de pedido web #{{ $pedido->id }}</h2>
                    </div>
                    <div class="buttons">
                        <a href="">
                            <md-fab size="small" aria-label="Edit">
                                <md-icon slot="icon">edit</md-icon>
                            </md-fab>
                        </a>
                        <!-- Botón para dialogo alerta eliminar -->
                        <a id="openDialogButton_{{ $pedido->id }}">
                            <md-fab class="boton-tabla" size="small" aria-label="Delete">
                                <md-icon slot="icon">delete</md-icon>
                            </md-fab>
                        </a>


                        {{-- area para imprimir en pdf (exportar y generer recibo) --}}
                        <div>
                            <a href="#" id="inpedidorioDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <md-fab class="boton-tabla" size="small" aria-label="Imprimir">
                                    <md-icon slot="icon">print</md-icon>
                                </md-fab>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="inpedidorioDropdown"
                                style="background-color: #e8def8; color: var(--md-sys-color-on-primary); border-radius: 20px; box-shadow: var(--md-sys-elevation-3);">

                                <li><a class="dropdown-item" target="_blank" href=""
                                        style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Generar
                                        Recibo</a></li>

                            </ul>
                        </div>


                    </div>
                </div>

                <!-- Separación por línea -->
                <hr class="divider">

                <!-- Detalles de precios y stock -->
                <div class="pricing-stock">
                    <div class="purchase-price">
                        <p>Cliente:</p>
                        <h3>{{ $pedido->nombre_cliente ?? 'No especificado' }}</h3>
                    </div>
                    <div class="purchase-price">
                        <p>E-mail Cliente:</p>
                        <h3>{{ $pedido->email_cliente ?? 'No especificado' }}</h3>
                    </div>
                    <div class="purchase-price">
                        <p>Celular Cliente:</p>
                        <h3>{{ $pedido->telefono_cliente ?? 'No especificado' }}</h3>
                    </div>
                </div>

                <br>


                <div class="pricing-stock">



                    <div class="stock-info">
                        <p>Fecha de pedido:</p>
                        {{-- formato de fecha en dia- mes - año --}}
                        <h3>{{ \Carbon\Carbon::parse($pedido->fecha_created_at)->format('d-m-Y') }}</h3>
                    </div>
                    <div class="purchase-price">
                        <p>Subtotal:</p>
                        <h3>${{ $pedido->total }}</h3>
                    </div>
                    <div class="purchase-price">
                        <p>Monto Pagado:</p>
                        <h3>${{ $pedido->monto_pagado }}</h3>
                    </div>
                    <div class="purchase-price">
                        <p>Estado de Pago:</p>
                        <h3> @switch($pedido->estado_pago)
                                @case(1)
                                    50%
                                @break

                                @case(2)
                                    Completado
                                @break
                            @endswitch
                        </h3>
                    </div>
                    <div class="purchase-price">
                        <p>Estado de Pedidos:</p>
                        <h3> @switch($pedido->estado_pedido)
                                @case(1)
                                    Pendiente
                                @break

                                @case(2)
                                    En transito
                                @break

                                @case(3)
                                    Listo para entrega
                                @break

                                @default
                                    Desconocido
                            @endswitch
                        </h3>


                    </div>
                </div>
            </div>
            <br>
            <div class="bottom-container">
                <h4>Productos de la venta</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detallesPedido as $detalle)
                            @if ($detalle->descuento == 0)
                                <tr>
                                    <td>{{ $detalle->producto->nombre }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>${{ number_format($detalle->precio, 0, ',', '.') }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <br>
            <div class="bottom-container">
                <h4>Productos del pedido</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Precio Unitario</th>
                            <th>Total</th>
                            <th>Pagado</th>
                            <th>Valor de deuda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detallesPedido as $detalle)
                            @if ($detalle->descuento > 0)
                                <tr>
                                    <td>{{ $detalle->producto->nombre }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                    <td>${{ number_format($detalle->precio, 0, ',', '.') }}</td>
                                    <td>${{ number_format($detalle->precio * $detalle->cantidad, 0, ',', '.') }}</td>
                                    <td>${{ number_format(($detalle->precio * $detalle->cantidad) / 2, 0, ',', '.') }}
                                    </td>
                                    <td>${{ number_format($detalle->descuento, 0, ',', '.') }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>

            <md-dialog id="dialog_{{ $pedido->id }}">
                <div slot="headline">
                    Anular pedido "{{ $pedido->id }}"
                </div>
                <form slot="content" id="form-id-{{ $pedido->id }}" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    Una vez que la pedido haya sido anulada, no será posible revertir los cambios realizados.
                    ¿Está seguro que desea Anular la pedido?
                </form>
                <div slot="actions">
                    <md-text-button id="closeButton_{{ $pedido->id }}">Cancelar</md-text-button>


                    <md-text-button type="submit" form="form-id-{{ $pedido->id }}">Anular</md-text-button>
                </div>
            </md-dialog>

            <script>
                document.addEventListener('DOMContentLoaded', () => {

                    // Obtener el botón y el diálogo con el id específico del producto
                    const openDialogButton_{{ $pedido->id }} = document.getElementById(
                        'openDialogButton_{{ $pedido->id }}');
                    const dialog_{{ $pedido->id }} = document.getElementById('dialog_{{ $pedido->id }}');
                    const closeButton_{{ $pedido->id }} = document.getElementById(
                        'closeButton_{{ $pedido->id }}');

                    // Añadir el evento para abrir el diálogo
                    openDialogButton_{{ $pedido->id }}.addEventListener('click', async () => {
                        await dialog_{{ $pedido->id }}.show(); // Abre el diálogo correspondiente
                    });

                    // Añadir el evento para cerrar el diálogo
                    closeButton_{{ $pedido->id }}.addEventListener('click', async () => {
                        await dialog_{{ $pedido->id }}.close(); // Cierra el diálogo correspondiente
                    });

                });
            </script>
        </div>
</x-app-layout>
