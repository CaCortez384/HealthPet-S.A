<x-app-layout>
    <link href="{{ asset('css/ventas/crear-venta-style.css') }}" rel="stylesheet">
    @include('components.alert')

    <div id="contenedor" data-productos-vendidos='@json($productosVendidos)'>
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
                <form action="{{ route('ventas.update', $venta->id) }}" method="POST" id="formulario-productos">
                    @csrf
                    @method('PUT')
<br>
                    <h6>Información del cliente</h6>

                    <div class="formulario-crear-user">

                        <script>
                            // Función para formatear el valor del RUT
                            function formatRut(value) {
                                // Elimina cualquier guion existente
                                value = value.replace(/-/g, '');
                        
                                // Asegúrate de que el valor tenga al menos 2 dígitos
                                if (value.length < 2) {
                                    return value; // Si no, retorna el valor original
                                }
                        
                                // Divide el valor en la parte antes del penúltimo dígito y el último dígito
                                return value.slice(0, -1) + '-' + value.slice(-1);
                            }
                        
                            // Función para aplicar el formato al cargar la página
                            function applyRutFormat() {
                                const input = document.getElementById('rut_cliente');
                                // Formatea el valor inicial del input
                                input.value = formatRut(input.value);
                            }
                        
                            // Aplicar el formato al cargar la página
                            document.addEventListener('DOMContentLoaded', applyRutFormat);
                        
                            // Agrega un evento de entrada para formatear en tiempo real
                            document.getElementById('rut_cliente').addEventListener('input', function() {
                                this.value = formatRut(this.value);
                            });
                        </script>


    <!-- Campo oculto para el ID de la venta -->
    <input type="hidden" name="venta_id" value="{{ $venta->id }}">

                       
                      
                        <md-filled-text-field type="text" label="Nombre del Cliente (opcional)" value="{{ $venta->nombre_cliente }}"
                            class="input-uniforme" id="nombre_cliente" name="nombre_cliente" placeholder="Juanito perez"
                            supporting-text="Ej: Juanito perez"></md-filled-text-field>

                        <div>
                            <md-filled-text-field type="text" label="Rut del cliente (opcional)" value="{{ $venta->rut_cliente }}"
                                class="input-uniforme" id="rut_cliente" name="rut_cliente" placeholder="1234567-0"
                                supporting-text="Formato: 11111111-1">
                                </md-filled-text-field>
                            <div id="msgerror" class="text-danger"></div>
                        </div>

                        <div>
                            <md-filled-text-field type="text" label="Telefono del cliente (opcional)" value="{{ $venta->numero_cliente }}"
                                class="input-uniforme" id="numero_cliente" name="numero_cliente" placeholder="12345678"
                                supporting-text="Formato: 12345678" minlength="8" maxlength="8"     prefix-text="+569">
                                </md-filled-text-field>
                            <div id="msgerror" class="text-danger"></div>
                        </div>

                        <div>
                            <md-filled-text-field type="email" label="E-mail del cliente (opcional)" value="{{ $venta->email_cliente }}"
                                class="input-uniforme" id="email_cliente" name="email_cliente" placeholder="juan@mail.com"
                                supporting-text="Formato: juan@mail.com" >
                                </md-filled-text-field>
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

                        <md-filled-text-field type="number" label="Descuento %" class="input-uniforme" value="{{ $venta->descuento}}"
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

                        <md-filled-text-field type="text" label="Monto pagado por el cliente"
                            class="input-uniforme" id="monto_pagado" name="monto_pagado" value="{{ $venta->monto_pagado }}"
                             oninput="updateMontoPagado()" required></md-filled-text-field>

                    </div>

                    <md-filled-text-field type="text" label="Notas" class="input-uniforme" id="descuento" value="{{ $venta->nota}}"
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


               <!-- Código del formulario -->

               <script src="{{ asset('js/ventas/editarVenta-js.js') }}"></script>
               <script>
                   const productosVendidos = @json($productosVendidos);
                   console.log(productosVendidos);  // Aquí debería verse el contenido de la variable
               </script>

    
</x-app-layout>
