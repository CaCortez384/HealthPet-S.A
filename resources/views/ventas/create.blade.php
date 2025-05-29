<x-app-layout>
    <link href="{{ asset('css/ventas/crear-venta-style.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/gh/djibe/material@4.6.2-1.0/css/material-plugins.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/quagga@0.12.1/dist/quagga.min.js"></script>

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
                    <br>
                    <h6>Información del cliente</h6>

                    <div class="formulario-crear-user">





                        <md-filled-text-field type="text" label="Nombre del Cliente (opcional)"
                            class="input-uniforme" id="nombre_cliente" name="nombre_cliente" placeholder="Juanito perez"
                            supporting-text="Ej: Juanito perez">></md-filled-text-field>

                        <div>
                            <md-filled-text-field type="text" label="Rut del cliente (opcional)"
                                class="input-uniforme" id="rut_cliente" name="rut_cliente" placeholder="1234567-0"
                                supporting-text="Formato: 11111111-1">
                            </md-filled-text-field>
                            <div id="msgerror" class="text-danger"></div>
                        </div>

                        <div>
                            <md-filled-text-field type="text" label="Telefono del cliente (opcional)"
                                class="input-uniforme" id="numero_cliente" name="numero_cliente" placeholder="12345678"
                                supporting-text="Formato: 12345678" minlength="8" maxlength="8" prefix-text="+569">
                            </md-filled-text-field>
                            <div id="msgerror" class="text-danger"></div>
                        </div>

                        <div>
                            <md-filled-text-field type="email" label="E-mail del cliente (opcional)"
                                class="input-uniforme" id="email_cliente" name="email_cliente"
                                placeholder="juan@mail.com" supporting-text="Formato: juan@mail.com">
                            </md-filled-text-field>
                            <div id="msgerror" class="text-danger"></div>
                        </div>
                    </div>

                    <md-divider inset></md-divider>




                    <br>
                    <h6>Productos</h6>
                    <br>
                    <div id="scanner-container"></div>

                    <md-fab id="activarScanner">
                        <md-icon slot="icon">camera_alt</md-icon>
                    </md-fab>

                    <div class="formulario-crear-agregar">

                        <select class="input-uniforme" id="productos" name="producto[][id_producto]"
                            onchange="mostrarCamposAdicionales()">
                            <option value="" data-codigo="" selected>Buscar en el inventario</option>
                            @foreach ($productos as $producto)
                                <option value="{{ $producto->id }}" data-codigo="{{ $producto->codigo }}"
                                    data-precio="{{ $producto->precio_de_venta }}"
                                    data-precioFraccionado="{{ $producto->precio_fraccionado }}"
                                    data-nombre="{{ $producto->nombre }}"
                                    data-presentacion="{{ $producto->id_presentacion }}">
                                    {{ $producto->codigo }} - {{ $producto->nombre }} -
                                    ${{ $producto->precio_de_venta }}
                                </option>
                            @endforeach
                        </select>

                        <input type="text" id="codigo_lector" placeholder="Escanea un código"
                            style="display: none;" />

                        <script>
                            $(document).ready(function() {
                                let scannerActive = false;

                                // Inicializa Select2 en el select de productos
                                $('#productos').select2({
                                    theme: 'filled',
                                    placeholder: 'Buscar por nombre o código',
                                    width: '400px'
                                });

                                // Iniciar la cámara para capturar el código de barras
                                function initScanner() {
                                    Quagga.init({
                                        inputStream: {
                                            type: "LiveStream",
                                            target: document.querySelector('#scanner-container'), // Donde se muestra el video
                                            constraints: {
                                                facingMode: "environment" // Usar la cámara trasera en dispositivos móviles
                                            }
                                        },
                                        decoder: {
                                            readers: ["code_128_reader", "ean_reader", "ean_8_reader",
                                                "upc_reader"
                                            ] // Tipos de códigos soportados
                                        }
                                    }, function(err) {
                                        if (err) {
                                            console.error(err);
                                            return;
                                        }
                                        Quagga.start();
                                    });

                                    // Detectar el código de barras cuando es leído
                                    Quagga.onDetected(function(result) {
                                        const codigoIngresado = result.codeResult.code; // Código escaneado
                                        console.log('Código detectado: ' + codigoIngresado);

                                        // Busca la opción correspondiente en el select por el atributo data-codigo
                                        let encontrado = false; // Bandera para saber si encontramos el código
                                        $('#productos option').each(function() {
                                            const codigoOpcion = $(this).data(
                                                'codigo'); // Obtiene el código almacenado en data-codigo

                                            console.log('Código en opción: ' + codigoOpcion);

                                            // Compara estrictamente el código escaneado con las opciones del select
                                            if (codigoOpcion && String(codigoOpcion) === String(codigoIngresado)) {
                                                $('#productos').val($(this).val()).trigger(
                                                    'change'); // Selecciona la opción
                                                encontrado = true;
                                                return false; // Rompe el loop
                                            }
                                        });

                                        if (!encontrado) {
                                            alert('Producto no encontrado.');
                                        } else {
                                            // Llenar el campo de cantidad con el valor 1
                                            $('#cantidad').val(1); // Establece el valor de cantidad en 1

                                            // Hacer clic en el botón "Añadir Producto" automáticamente
                                            $('#agregarProducto').click();
                                        }

                                        // Detener Quagga después de procesar el código
                                        Quagga.stop();
                                        scannerActive = false;
                                        $('#activarScanner').prop('disabled', false).text('');
                                    });

                                }

                                // Activa o desactiva el escáner cuando se hace clic en el botón
                                $('#activarScanner').on('click', function() {
                                    if (!scannerActive) {
                                        initScanner();
                                    } else {
                                        Quagga.stop();
                                    }
                                    scannerActive = !scannerActive;
                                });

                                // Activa el campo oculto para que reciba el enfoque
                                $(document).on('keypress', function() {
                                    $('#codigo_lector').focus();
                                });
                            });
                        </script>


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
                            <md-filled-text-field class="input-uniforme" label="Cantidad" value=""
                                type="number" name="producto[][cantidad]" min="0" max="999999999"
                                id="cantidad" style="display: none;">
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
                            @foreach ($tipoPago as $tipo)
                                <md-select-option value="{{ $tipo->id }}">
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

                        <md-filled-text-field type="text" label="Monto pagado por el cliente"
                            class="input-uniforme" id="monto_pagado" name="monto_pagado" value=""
                            oninput="updateMontoPagado()" required></md-filled-text-field>

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
