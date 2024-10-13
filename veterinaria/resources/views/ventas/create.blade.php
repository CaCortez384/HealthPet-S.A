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

                        <md-filled-select class="input-uniforme" id="productos" name="producto[][id_producto]">
                            <md-select-option value="" selected>Buscar en el inventario</md-select-option>
                            @foreach ($productos as $producto)
                                <md-select-option value="{{ $producto->id }}"
                                    data-precio="{{ $producto->precio_de_venta }}"
                                    data-nombre="{{ $producto->nombre }}">
                                    {{ $producto->nombre }} - ${{ $producto->precio_de_venta }}
                                </md-select-option>
                            @endforeach
                        </md-filled-select>

                        <md-filled-text-field type="number" label="Cantidad" class="input-uniforme" id="cantidad"
                            name="producto[][cantidad]" value="1" min="1" required></md-filled-text-field>



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

                        <md-filled-text-field type="number" label="Descuento %" class="input-uniforme" id="descuento"
                            name="descuento" value="0" min="0" max="100"></md-filled-text-field>

                        <md-filled-text-field type="text" label="Total" class="input-uniforme" id="total"
                            name="total" readonly></md-filled-text-field>


                        {{-- <md-filled-text-field type="number" label="Monto pagado por el cliente" class="input-uniforme"
                            id="descuento" name="monto_pagado" value="0"></md-filled-text-field>
                        
                        </div> --}}



                        <!-- Nueva sección para el monto pagado -->
                        {{-- <md-filled-text-field type="text" label="Total a pagar" class="input-uniforme" id="total_pagar" name="total_pagar" value="0" readonly></md-filled-text-field> --}}
                        <h1></h1>
                        
                        <div>
                            <h6>pago total venta</h6>
                            <md-checkbox id="permitir_modificar" onclick="toggleMontoPagado()">Permitir modificar monto
                                pagado</md-checkbox>
                        </div>

                        <md-filled-text-field type="text" label="Monto pagado por el cliente" class="input-uniforme"
                            id="monto_pagado" name="monto_pagado" 
                            oninput="updateMontoPagado()"></md-filled-text-field>
                    </div>





                    <md-filled-text-field type="text" label="Notas" class="input-uniforme" id="descuento"
                        name="nota"></md-filled-text-field>

                    <div id="boton-enviar">
                        <button type="submit" style="all:unset; cursor:pointer;">
                            <md-fab size="large" label="Generar venta">
                                <md-icon slot="icon">save</md-icon>
                            </md-fab>
                        </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const openDialogButton = document.getElementById('openDialogButton');
        const deleteDialog = document.getElementById('deleteDialog');
        const cancelButton = document.getElementById('cancelButton');

        openDialogButton.addEventListener('click', async () => {
            await deleteDialog.show();
        });

        cancelButton.addEventListener('click', async () => {
            await deleteDialog.close();
        });

        let productosSeleccionados = [];
        let productoCounter = 0;

        document.getElementById('agregarProducto').addEventListener('click', () => {
            let productoSelect = document.getElementById('productos');
            let cantidadInput = document.getElementById('cantidad');
            let productoId = productoSelect.value;
            let productoNombre = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-nombre');
            let productoPrecio = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precio');
            let cantidad = parseInt(cantidadInput.value);

            if (productoId && cantidad > 0) {
                // Verificar si el producto ya existe en el carrito
                let productoExistente = productosSeleccionados.find(producto => producto.id === productoId);

                if (productoExistente) {
                    // Aumentar la cantidad si ya existe
                    productoExistente.cantidad += cantidad;
                } else {
                    // Si no existe, agregar nuevo producto
                    productosSeleccionados.push({
                        id: productoId,
                        nombre: productoNombre,
                        precio: productoPrecio,
                        cantidad: cantidad
                    });
                }

                // Actualizar la vista
                actualizarCarrito();

                // Actualizar el DOM con los productos
                renderizarProductos();
            }
        });

        function renderizarProductos() {
            // Limpiar la lista actual
            document.getElementById('listaProductos').innerHTML = '';

            // Agregar todos los productos en el carrito al DOM
            productosSeleccionados.forEach((producto, index) => {
                let newProductHtml = `
            <div class="producto_carrito" id="producto-${producto.id}">
                <md-filled-text-field type="text" label="Nombre del Producto" class="input-uniforme" 
                    value="${producto.nombre}" disabled></md-filled-text-field>
                <md-filled-text-field type="text" label="Cantidad" class="input-uniforme" 
                    value="${producto.cantidad}" disabled></md-filled-text-field>
                <md-filled-text-field type="text" label="Precio" class="input-uniforme" 
                    value="${producto.precio}" disabled></md-filled-text-field>
                <md-icon-button onclick="eliminarProducto(event, String(${producto.id}))" style=" --md-icon-button-icon-color: #dc362e;">
                    <md-icon>delete</md-icon>
                </md-icon-button>
                <input type="hidden" name="productos[${index}][id_producto]" value="${producto.id}">
                <input type="hidden" name="productos[${index}][cantidad]" value="${producto.cantidad}">
                <input type="hidden" name="productos[${index}][precio_unitario]" value="${producto.precio}">
            </div>
        `;
                document.getElementById('listaProductos').insertAdjacentHTML('beforeend', newProductHtml);
            });
        }


        // Función para eliminar productos
        function eliminarProducto(event, productoId) {
            event.preventDefault(); // Evita que se envíe el formulario
            console.log("Productos después de la eliminación:", productosSeleccionados);
            // Eliminar el producto del array utilizando el ID
            productosSeleccionados = productosSeleccionados.filter(producto => producto.id !== productoId);

            // Comprobar si la eliminación fue exitosa
            console.log("Productos después de la eliminación:", productosSeleccionados);

            // Remover el producto del DOM
            const productoDiv = document.getElementById(`producto-${productoId}`);
            if (productoDiv) {
                productoDiv.remove();
            }

            // Recalcular y actualizar el carrito
            actualizarCarrito();
        }



        function actualizarCarrito() {
            let subtotal = 0;

            productosSeleccionados.forEach((producto) => {
                // Eliminar puntos del precio antes de multiplicar
                let precioSinPuntos = producto.precio.toString().replace(/\./g, '');


                let precioDecimal = parseFloat(precioSinPuntos); // Cambiar a parseFloat para conservar decimales
                subtotal += precioDecimal * producto.cantidad; // Mantener el subtotal como decimal
            });

            // Formatear el subtotal con separadores de miles y mantener los ceros finales
            document.getElementById('subtotal').value = new Intl.NumberFormat('es-CL', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(subtotal);
            actualizarTotal();


            console.log("Productos en el carrito:", productosSeleccionados);
        }







        document.getElementById('descuento').addEventListener('input', actualizarTotal);



        function actualizarTotal() {
            // Eliminar puntos del subtotal antes de calcular
            let subtotalSinPuntos = document.getElementById('subtotal').value.replace(/\./g, '');
            let subtotal = parseFloat(subtotalSinPuntos) || 0; // Cambiar a parseFloat para conservar decimales

            let descuento = parseFloat(document.getElementById('descuento').value) || 0;

            // Asegurarse de que el descuento esté en el rango válido
            if (descuento < 0 || descuento > 100) {
                alert('El descuento debe estar entre 0 y 100');
                return;
            }

            // Calcular el total aplicando el descuento
            let total = subtotal - (subtotal * (descuento / 100));

            // Formatear el total con separadores de miles y mantener los ceros finales
            document.getElementById('total').value = new Intl.NumberFormat('es-CL', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            }).format(total);
        }



        var Fn = {
            validaRut: function(rutCompleto) {
                rutCompleto = rutCompleto.replace("‐", "-");
                if (!/^[0-9]+[-|‐]{1}[0-9kK]{1}$/.test(rutCompleto))
                    return false;
                var tmp = rutCompleto.split('-');
                var digv = tmp[1];
                var rut = tmp[0];
                if (digv == 'K') digv = 'k';
                return (Fn.dv(rut) == digv);
            },
            dv: function(T) {
                var M = 0,
                    S = 1;
                for (; T; T = Math.floor(T / 10))
                    S = (S + T % 10 * (9 - M++ % 6)) % 11;
                return S ? S - 1 : 'k';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var rutInput = document.getElementById('rut_cliente');
            var msgError = document.getElementById('msgerror');

            rutInput.addEventListener('input', function() {
                if (Fn.validaRut(rutInput.value)) {
                    msgError.innerHTML = "El Rut ingresado es válido";
                    msgError.classList.remove('text-danger');
                    msgError.classList.add('text-success');
                } else {
                    msgError.innerHTML = "El Rut no es válido";
                    msgError.classList.remove('text-success');
                    msgError.classList.add('text-danger');
                }
            });
        });







        function toggleMontoPagado() {
            const permitirModificar = document.getElementById('permitir_modificar').checked;
            const montoPagadoInput = document.getElementById('monto_pagado');

            if (permitirModificar) {
                montoPagadoInput.removeAttribute('readonly'); // Permite la edición
            } else {
                montoPagadoInput.setAttribute('readonly', true); // Bloquea la edición
                // Opcional: reinicia el valor al total si se bloquea
                montoPagadoInput.value = document.getElementById('total').value;
            }
        }

        function updateMontoPagado() {
            const total = parseFloat(document.getElementById('total').value) || 0;
            const montoPagado = parseFloat(document.getElementById('monto_pagado').value) || 0;

            // Asegurarse de que el monto pagado no exceda el total
            if (montoPagado > total) {
                alert('El monto pagado no puede ser mayor que el total.');
                document.getElementById('monto_pagado').value = total; // Reinicia al total
            }
        }
    </script>
</x-app-layout>
