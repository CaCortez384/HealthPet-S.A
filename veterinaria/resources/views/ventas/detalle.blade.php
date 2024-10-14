<x-app-layout>

    <link href="{{ asset('css\ventas\detalle-venta-style.css') }}" rel="stylesheet">


    <div class="contenedor">
        <div class="top-container">
            <div class="product-details-container">
                <div id="volver-titulo">
                    <a href="{{ route('ventas.index') }}">
                        <md-icon-button id="openDialogButton">
                            <md-icon>arrow_back</md-icon>
                        </md-icon-button>
                    </a>
                </div>
                <!-- Encabezado: Nombre del producto y botones -->
                
                <div class="header2">
                    <div class="product-name">
                        <h2>Detalle de la Venta #{{ $venta->id }}</h2>
                    </div>
                    <div class="buttons">
                        <a href="ruta para editar la venta">
                            <md-fab size="small" aria-label="Edit">
                                <md-icon slot="icon">edit</md-icon>
                            </md-fab>
                        </a>
                        <!-- Botón para dialogo alerta eliminar -->
                        <a id="openDialogButton_{{ $venta->id }}">
                            <md-fab class="boton-tabla" size="small" aria-label="Delete">
                                <md-icon slot="icon">delete</md-icon>
                            </md-fab>
                        </a>


                        {{-- area para imprimir en pdf (exportar y generer recibo) --}}
                        <div>
                            <a href="#" id="inventarioDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <md-fab class="boton-tabla" size="small" aria-label="Imprimir">
                                    <md-icon slot="icon">print</md-icon>
                                </md-fab>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="inventarioDropdown"
                                style="background-color: #e8def8; color: var(--md-sys-color-on-primary); border-radius: 20px; box-shadow: var(--md-sys-elevation-3);">

                                <li><a class="dropdown-item"  target="_blank"  href="{{ route('venta.recibo', $venta->id) }}"
                                        style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Generar Recibo</a></li>

                            </ul>
                        </div>

    
                    </div>
                </div>

                <!-- Separación por línea -->
                <hr class="divider">

                <!-- Detalles de precios y stock -->
                <div class="pricing-stock">
                    <div class="purchase-price">
                        <p>Vendedor:</p>
                        <h3>{{ $venta->nombre_cliente ?? 'No especificado'  }}</h3>
                    </div>
                    <div class="purchase-price">
                        <p>Cliente:</p>
                        <h3>{{ $venta->nombre_cliente ?? 'No especificado'  }}</h3>
                    </div>
                    <div class="sale-price">
                        <p>RUT Cliente:</p>
                        <h3>{{ $venta->rut_cliente ?? 'No especificado' }}</h3>
                    </div>
                </div>
 

                <div class="pricing-stock">
                    

                  
                    <div class="stock-info">
                        <p>Fecha de Venta:</p>
                        <h3> {{ $venta->fecha_venta }}</h3>
                    </div>
                    <div class="purchase-price">
                        <p>Subtotal:</p>
                        <h3>{{ $venta->subtotal}} CLP</h3>
                    </div>
                    <div class="purchase-price">
                        <p>Descuento:</p>
                        <h3>{{ $venta->descuento }}%</h3>
                    </div>
                    <div class="purchase-price">
                        <p>Total:</p>
                        <h3>{{$venta->total}} CLP</h3>
                    </div>
                    <div class="purchase-price">
                        <p>Monto Pagado:</p>
                        <h3>{{ $venta->monto_pagado}} CLP</h3>
                    </div>                    
                    <div class="purchase-price">
                        <p>Estado de Pago:</p>
                        <h3> @switch($venta->estado_pago)
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
                    </h3>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="bottom-container">
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
    </div>
        <md-dialog id="dialog_{{ $venta->id }}">
            <div slot="headline">
                Anular Venta "{{ $venta->id }}"
            </div>
            <form slot="content" id="form-id-{{ $venta->id }}" method="POST"
                action="{{ route('ventas.destroy',  $venta->id ) }}">
                @csrf
                @method('DELETE')
                ¿Está seguro que desea Anular la venta?
            </form>
            <div slot="actions">
                <md-text-button id="closeButton_{{ $venta->id }}">Cancelar</md-text-button>

                
         <md-text-button type="submit" form="form-id-{{ $venta->id }}">Anular</md-text-button>
            </div>
        </md-dialog> 

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                // Obtener el botón y el diálogo con el id específico del producto
                const openDialogButton_{{$venta->id}} = document.getElementById(
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

            });
        </script>

</x-app-layout>