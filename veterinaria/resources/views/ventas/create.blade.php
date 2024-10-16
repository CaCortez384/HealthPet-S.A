<x-app-layout>
    <link href="{{ asset('css/ventas/crear-venta-style.css') }}" rel="stylesheet">
    @include('components.alert')

    <div id="contenedor">
        <div>
            <div id="volver-titulo">
                <md-icon-button id="openDialogButton">
                    <md-icon>arrow_back</md-icon>
                </md-icon-button>
                <h6>Nueva venta</h6>
                <md-dialog id="deleteDialog" type="alert">
                    <div slot="headline">¿Desea volver a la p&aacute;gina anterior?</div>
                    <form slot="content" id="form-id" method="dialog">
                        Si regresa, los datos no se guardar&aacute;n.
                    </form>
                    <div slot="actions">
                        <md-text-button id="cancelButton" value="cancel">Cancel</md-text-button>
                        <a href="javascript:history.back()"><md-text-button value="delete">Volver</md-text-button></a>
                    </div>
                </md-dialog>
            </div>

            <md-divider inset></md-divider>

            <div>
                <form action="{{ route('ventas.store') }}" method="POST" id="formulario-productos">
                    @csrf

                    <div class="formulario-crear">



                        <h6>Información del cliente</h6>
                        <br>
                        <md-filled-text-field type="text" label="Nombre del Cliente (opcional)"
                            class="input-uniforme" id="nombre_cliente" name="nombre_cliente" placeholder="Juanito perez"
                            supporting-text="Ej: Juanito perez">></md-filled-text-field>

                        <div>
                            <md-filled-text-field type="text" label="Rut del cliente (opcional)"
                                class="input-uniforme" id="rut_cliente" name="rut_cliente" placeholder="1234567-0"
                                supporting-text="Formato: 11111111-1">
                                ></md-filled-text-field>
                            <div id="msgerror" class="text-danger"></div>
                        </div>
                    </div>

                    <md-divider inset></md-divider>




                    <br>
                    <h6>Productos</h6>
                    <br>

                    <div class="formulario-crear-agregar">

                        <md-filled-select class="input-uniforme" id="productos" name="producto[][id_producto]"
                            onchange="mostrarCamposAdicionales()">
                            <md-select-option value="" selected>Buscar en el inventario</md-select-option>
                            @foreach ($productos as $producto)
                                <md-select-option value="{{ $producto->id }}"
                                    data-precio="{{ $producto->precio_de_venta }}"
                                    data-precioFraccionado="{{ $producto->precio_fraccionado }}"
                                    data-nombre="{{ $producto->nombre }}"
                                    data-presentacion="{{ $producto->id_presentacion }}">
                                    {{ $producto->nombre }} - ${{ $producto->precio_de_venta }}
                                </md-select-option>
                            @endforeach
                        </md-filled-select>

                        <md-filled-select class="input-uniforme" id="tipo_venta" name="tipo_venta"
                            onchange="mostrarCamposAdicionales()">
                            <md-select-option value="completo" selected>Completo</md-select-option>
                            <md-select-option value="fraccionado">Fraccionado</md-select-option>
                        </md-filled-select>
                        {{-- campos adicionales para fraccionado --}}
                        <div id="cantidadCampos">
                            <md-filled-text-field class="input-uniforme" label="Cantidad de comprimidos" value=""
                                type="number" name="comprimidos_por_caja" min="0" max="999999999"
                                id="cantidad_comprimidos" style="display: none;">
                            </md-filled-text-field>
                            <md-filled-text-field class="input-uniforme" label="Cantidad de ml" value=""
                                type="number" name="ml_por_unidad" min="0" max="999999999" id="cantidad_ml"
                                style="display: none;">
                            </md-filled-text-field>
                            <md-filled-text-field class="input-uniforme" label="Cantidad de unidades" value=""
                                type="number" name="unidades_por_envase" min="0" max="999999999"
                                id="cantidad_unidades" style="display: none;">
                            </md-filled-text-field>
                            <md-filled-text-field class="input-uniforme" label="Cantidad" value="" type="number"
                                name="producto[][cantidad]" min="0" max="999999999" id="cantidad"
                                style="display: none;">
                            </md-filled-text-field>
                        </div>
                        {{-- script para mostrar campos adicionales --}}
                        <script>
                            function mostrarCamposAdicionales() {
                                const productoSelect = document.getElementById('productos');
                                const tipoVentaSelect = document.getElementById('tipo_venta');
                                const presentacion = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-presentacion');
                                const tipoVenta = tipoVentaSelect.value;
                                const cantidadComprimidos = document.getElementById('cantidad_comprimidos');
                                const cantidadMl = document.getElementById('cantidad_ml');
                                const cantidadUnidades = document.getElementById('cantidad_unidades');
                                const cantidad = document.getElementById('cantidad');
                                // Ocultar todos los campos inicialmente
                                cantidadComprimidos.style.display = 'none';
                                cantidadMl.style.display = 'none';
                                cantidadUnidades.style.display = 'none';
                                cantidad.style.display = 'none';

                                if (tipoVenta === 'completo') {
                                    cantidad.style.display = 'block';
                                } else if (tipoVenta === 'fraccionado') {
                                    // Mostrar el campo correspondiente según la selección
                                    if (presentacion == '1') {
                                        cantidadComprimidos.style.display = 'block';
                                    } else if (presentacion == '2') {
                                        cantidadMl.style.display = 'block';
                                    } else if (presentacion == '3') {
                                        cantidadUnidades.style.display = 'block';
                                    }
                                }
                            }
                        </script>

                        <md-fab label="Añadir Producto" id="agregarProducto">
                            <md-icon slot="icon">add</md-icon>
                        </md-fab>
                    </div>
                    <br>
                    <div id="listaProductos"></div>
                    <br>

                    <md-divider inset></md-divider>
                    <br>

                    <h6>Resumen de Venta</h6>

                    <div class="formulario-crear">
                        <md-filled-text-field type="text" label="Subtotal" class="input-uniforme" id="subtotal"
                            name="subtotal" readonly></md-filled-text-field>

                        <md-filled-text-field type="number" label="Descuento %" class="input-uniforme"
                            id="descuento" name="descuento" value="0" min="0"
                            max="100"></md-filled-text-field>

                        <md-filled-text-field type="text" label="Total" class="input-uniforme" id="total"
                            name="total" readonly></md-filled-text-field>

                            <md-filled-select class="input-uniforme" name="tipo_pago_id" id="tipo_pago" required>
                            <md-select-option value="" selected>Seleccione el Tipo de Pago</md-select-option>
                            @foreach($tipoPago as $tipo)
                                <md-select-option  value="{{ $tipo->id }}">
                                    {{ $tipo->nombre }}
                                </md-select-option>
                            @endforeach
                        </md-filled-select>

                        <div>
                            <h6>pago total venta</h6>
                            <md-checkbox id="permitir_modificar" onclick="toggleMontoPagado()">Permitir modificar
                                monto
                                pagado</md-checkbox>
                        </div>

                        <md-filled-text-field type="number" label="Monto pagado por el cliente"
                            class="input-uniforme" id="monto_pagado" name="monto_pagado" value=""
                            min="0" oninput="updateMontoPagado()" required></md-filled-text-field>

                    </div>

                    <md-filled-text-field type="text" label="Notas" class="input-uniforme" id="descuento"
                        name="nota"></md-filled-text-field>

                    <div id="boton-enviar">
                        <button type="submit" style="all:unset; cursor:pointer;">
                            <md-fab size="large" label="Generar venta">
                                <md-icon slot="icon">save</md-icon>
                            </md-fab>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/ventas/createVenta-js.js') }}"></script>
</x-app-layout>
