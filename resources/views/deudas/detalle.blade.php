<x-app-layout>

    <link href="{{ asset('css\ventas\detalle-venta-style.css') }}" rel="stylesheet">

    {{-- funcion para formatear rut solo en esta vista --}}
    @php
        function formatearRut($rut)
        {
            // Eliminar cualquier carácter que no sea dígito
            $rut = preg_replace('/\D/', '', $rut);

            // Si el RUT tiene menos de 9 dígitos, agregar un 0 al principio
            if (strlen($rut) < 9) {
                $rut = str_pad($rut, 9, '0', STR_PAD_LEFT);
            }

            // Separar el cuerpo y el dígito verificador
            $cuerpo = substr($rut, 0, -1);
            $dv = substr($rut, -1);

            // Formatear el cuerpo del RUT con puntos
            $cuerpo_formateado = number_format($cuerpo, 0, '', '.');

            // Retornar el RUT formateado con el dígito verificador
            return $cuerpo_formateado . '-' . $dv;
        }
    @endphp

    <div class="contenedor">
        <div class="top-container">
            <div class="product-details-container">
                <div id="volver-titulo">
                    <a href="{{ route('deudas.index') }}">
                        <md-icon-button id="openDialogButton">
                            <md-icon>arrow_back</md-icon>
                        </md-icon-button>
                    </a>
                </div>
                <!-- Encabezado: Nombre del producto y botones -->

                <div class="header2">
                    <div class="product-name">
                        <h2>Detalle de la deuda de {{ $deuda->venta->nombre_cliente }}</h2>
                    </div>
                    <div class="buttons">
                        <a href="{{ route('ventas.show', ['id' => $deuda->venta->id]) }}">
                            <md-fab size="small" aria-label="Edit">
                                <md-icon slot="icon">visibility</md-icon>
                            </md-fab>
                        </a>
                    </div>
                </div>

                <!-- Separación por línea -->
                <hr class="divider">

                <!-- Detalles de precios y stock -->
                <div class="pricing-stock">
                    <div class="purchase-price">
                        <p>Cliente:</p>
                        <h3>{{ $deuda->venta->nombre_cliente ?? 'No especificado' }}</h3>
                    </div>
                    <div class="sale-price">
                        <p>RUT Cliente:</p>
                        <h3>{{ isset($deuda->venta->rut_cliente) ? formatearRut($deuda->venta->rut_cliente) : 'No especificado' }}
                        </h3>
                    </div>
                    <div class="purchase-price">
                        <p>E-mail Cliente:</p>
                        <h3>{{ $deuda->venta->email_cliente ?? 'No especificado' }}</h3>
                    </div>
                    <div class="purchase-price">
                        <p>Celular Cliente:</p>
                        <h3>+569 {{ $deuda->venta->numero_cliente ?? 'No especificado' }}</h3>
                    </div>
                </div>
                <br>
                <!-- Separación por línea -->
                <hr class="divider">

                <div class="pricing-stock">


                    <div class="stock-info">
                        <p>Fecha de Venta:</p>
                        {{-- formato de fecha en dia- mes - año --}}
                        <h3>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y') }}</h3>
                    </div>
                    <div class="purchase-price">
                        <p>Fecha de ultimo pago:</p>
                        <h3>{{ $deuda->pagos->isNotEmpty() ? \Carbon\Carbon::parse($deuda->pagos->sortByDesc('created_at')->first()->created_at)->format('d-m-Y') : 'No hay datos' }}
                        </h3>
                    </div>
                    <div class="purchase-price">
                        <p>Total por pagar:</p>
                        <h3>${{ number_format($deuda->monto_adeudado, 0, ',', '.') }} </h3>
                    </div>
                    <div class="purchase-price">
                        <p>Estado de Pago:</p>
                        <h3> @switch($deuda->venta->estado_pago)
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
        <h4>Historial de pagos</h4>
        <div class="buttons">
            <a href="#" id="openPagoModal">
                <md-fab size="small" aria-label="Edit">
                    <md-icon slot="icon">add</md-icon>
                </md-fab>
            </a>


        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Cantidad pagada</th>
                    <th>Fecha de pago</th>
                    <th>Medio de pago</th>
                    <th>Monto restante</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deuda->pagos as $pago)
                    <tr>
                        <td>${{ number_format($pago->monto_pagado, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($pago->created_at)->format('d-m-Y') }}</td>
                        <td>{{ $pago->tipoPago->nombre }}</td>
                        <td>${{ number_format($pago->monto_restante, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <md-dialog id="dialog_{{ $deuda->venta->id }}">
        <div slot="headline">
            Anular Venta "{{ $venta->id }}"
        </div>
        <form slot="content" id="form-id-{{ $deuda->venta->id }}" method="POST"
            action="{{ route('ventas.destroy', $deuda->venta->id) }}">
            @csrf
            @method('DELETE')
            Una vez que la venta haya sido anulada, no será posible revertir los cambios realizados.
            ¿Está seguro que desea Anular la venta?
        </form>
        <div slot="actions">
            <md-text-button id="closeButton_{{ $deuda->venta->id }}">Cancelar</md-text-button>


            <md-text-button type="submit" form="form-id-{{ $deuda->venta->id }}">Anular</md-text-button>
        </div>
    </md-dialog>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            // Obtener el botón y el diálogo con el id específico del producto
            const openDialogButton_{{ $deuda->venta->id }} = document.getElementById(
                'openDialogButton_{{ $deuda->venta->id }}');
            const dialog_{{ $deuda->venta->id }} = document.getElementById('dialog_{{ $deuda->venta->id }}');
            const closeButton_{{ $deuda->venta->id }} = document.getElementById(
                'closeButton_{{ $deuda->venta->id }}');

            // Añadir el evento para abrir el diálogo
            openDialogButton_{{ $deuda->venta->id }}.addEventListener('click', async () => {
                await dialog_{{ $deuda->venta->id }}.show(); // Abre el diálogo correspondiente
            });

            // Añadir el evento para cerrar el diálogo
            closeButton_{{ $deuda->venta->id }}.addEventListener('click', async () => {
                await dialog_{{ $deuda->venta->id }}.close(); // Cierra el diálogo correspondiente
            });

        });
    </script>
    <!-- Modal -->
    <md-dialog id="pagoModal" ?quick=${quick} ?no-focus-trap=${noFocusTrap}>
        <span slot="headline">
            <md-icon-button id="closePagoModal" aria-label="Close dialog">
                <md-icon>close</md-icon>
            </md-icon-button>
            <span class="headline">Registrar nuevo pago</span>
        </span>
        <form id="form" slot="content" method="POST" action="{{ route('pago.store') }}" class="contact-content">
            @csrf
            <input type="hidden" name="deuda_id" value="{{ $deuda->id }}">
            <div class="contact-row">
                <md-filled-text-field type="text" name="monto_pagado" autofocus label="Monto a pagar" placeholder="$" required oninput="this.value = this.value.replace(/\./g, '')"></md-filled-text-field>
                <md-filled-select class="input-uniforme" name="tipo_pago_id" id="tipo_pago" required>
                    <md-select-option value="" selected>Seleccione el Tipo de Pago</md-select-option>
                    @foreach ($tipoPago1 as $tipo)
                        <md-select-option value="{{ $tipo->id }}">
                            {{ $tipo->nombre }}
                        </md-select-option>
                    @endforeach
                </md-filled-select>
            </div>
        </form>
        <div slot="actions">
            <div style="flex: 1"></div>
            <md-text-button type="submit" form="form">Pagar</md-text-button>
        </div>
    </md-dialog>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const openPagoModalButton = document.getElementById('openPagoModal');
            const pagoModal = document.getElementById('pagoModal');
            const closePagoModalButton = document.getElementById('closePagoModal');

            openPagoModalButton.addEventListener('click', async () => {
                await pagoModal.show();
            });

            closePagoModalButton.addEventListener('click', async () => {
                await pagoModal.close();
            });
        });
    </script>

</x-app-layout>
