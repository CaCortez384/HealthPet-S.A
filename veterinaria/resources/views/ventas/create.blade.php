<x-app-layout>
    <link href="{{ asset('css/ventas/crear-venta-style.css') }}" rel="stylesheet">

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
                    <div id="formulario-crear">
                        <label for="informacion_cliente">Información del cliente</label>
                        <br>
                        <md-filled-text-field class="input-uniforme" id="nombre_cliente" name="nombre_cliente"
                            placeholder="Juanito Perez" required></md-filled-text-field>

                        <div>
                            <md-filled-text-field class="input-uniforme" label="Rut del cliente" id="rut_cliente"
                                name="rut_cliente" placeholder="1234567-0" required></md-filled-text-field>
                            <div id="msgerror" class="text-danger"></div>
                        </div>

                        <md-divider inset>Información de venta</md-divider>
                        <br>

                        <md-filled-select class="input-uniforme" label="Producto/Servicio" id="productos" name="producto[][id_producto]">
                            <md-select-option value="" selected>Buscar en el inventario</md-select-option>
                            @foreach ($productos as $producto)
                                <md-select-option value="{{ $producto->id }}" data-precio="{{ $producto->precio_de_venta }}">
                                    {{ $producto->nombre }} - ${{ $producto->precio_de_venta }}
                                </md-select-option>
                            @endforeach
                        </md-filled-select>

                        <md-filled-text-field class="input-uniforme" id="cantidad" name="producto[][cantidad]"
                            value="1" min="1" required></md-filled-text-field>

                        <button type="button" class="btn btn-secondary" id="agregarProducto">Agregar otro producto</button>
                        <br>
                        <div id="listaProductos"></div>
                        <br>
                        <md-filled-text-field id="subtotal" class="input-uniforme" label="Subtotal" type="number"
                            name="subtotal" readonly></md-filled-text-field>

                        <md-filled-text-field id="descuento" class="input-uniforme" label="Descuento" type="number"
                            name="descuento" min="0" max="100" required></md-filled-text-field>

                        <md-filled-text-field id="total" class="input-uniforme" label="Total" type="number"
                            name="total" readonly></md-filled-text-field>

                        <md-filled-text-field id="notas" class="input-uniforme" label="Notas" type="text"
                            name="notas"></md-filled-text-field>
                    </div>
                    <div id="boton-enviar">
                        <md-fab onclick="submitForm(event)" size="large" label="Generar venta">
                            <md-icon slot="icon">save</md-icon>
                        </md-fab>
                    </div>
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
            let productoNombre = productoSelect.options[productoSelect.selectedIndex].text;
            let productoPrecio = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precio');
            let cantidad = cantidadInput.value;

            if (productoId && cantidad > 0) {
                productosSeleccionados.push({
                    id: productoId,
                    nombre: productoNombre,
                    precio: parseFloat(productoPrecio),
                    cantidad: parseInt(cantidad)
                });

                let newProductHtml = `
                <div class="producto mb-2" id="producto-${productoCounter}">
                    <p>Producto: ${productoNombre} - Cantidad: ${cantidad} - Precio: $${productoPrecio}</p>
                    <button type="button" class="btn btn-danger" onclick="eliminarProducto(${productoCounter})">Eliminar</button>
                    <input type="hidden" name="productos[${productoCounter}][id_producto]" value="${productoId}">
                    <input type="hidden" name="productos[${productoCounter}][cantidad]" value="${cantidad}">
                    <input type="hidden" name="productos[${productoCounter}][precio_unitario]" value="${productoPrecio}">
                </div>
            `;
                document.getElementById('listaProductos').insertAdjacentHTML('beforeend', newProductHtml);
                productoCounter++;
                actualizarCarrito();
            }
        });

        function actualizarCarrito() {
            let subtotal = 0;

            productosSeleccionados.forEach((producto) => {
                subtotal += producto.precio * producto.cantidad;
            });

            document.getElementById('subtotal').value = subtotal;
            actualizarTotal();
        }

        function eliminarProducto(index) {
            productosSeleccionados.splice(index, 1);
            document.getElementById(`producto-${index}`).remove();
            actualizarCarrito();
        }

        document.getElementById('descuento').addEventListener('input', actualizarTotal);

        function actualizarTotal() {
            let subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
            let descuento = parseFloat(document.getElementById('descuento').value) || 0;
            let total = subtotal - (subtotal * (descuento / 100));
            document.getElementById('total').value = total;
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
    </script>
</x-app-layout>
