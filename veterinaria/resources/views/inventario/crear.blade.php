<x-app-layout>


    <link href="{{ asset('css\crear-producto-style.css') }}" rel="stylesheet">

    <div id="contenedor">
        <div>
            <div id="volver-titulo">

                <md-icon-button id="openDialogButton">
                    <md-icon>arrow_back</md-icon>
                </md-icon-button>

                <h6>Agregar producto</h6>

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

                <form action="{{ route('inventario.store') }}" method="POST" id="formulario-productos">
                    @csrf
                    <div id="formulario-crear">

                        <md-filled-text-field class= "input-uniforme" label="Nombre del producto" value=""
                            name="nombre" required>
                        </md-filled-text-field>

                        <md-filled-select class="input-uniforme" label="Especie" name="especie" id="especie">
                            <md-select-option value="" selected>Selecciona una opción</md-select-option>
                            @foreach ($especies as $especie)
                                <md-select-option value="{{ $especie->id }}">{{ $especie->nombre }}</md-select-option>
                            @endforeach
                        </md-filled-select>

                        <md-filled-text-field class="input-uniforme" label="Codigo" value="" type="number"
                            name="codigo" min="0" max="999999999" id="codigo" required>
                        </md-filled-text-field>

                        <md-filled-select class="input-uniforme" label="Categoría" name="categoria" id="categoria"
                            onchange="filtrarPresentaciones()">
                            <md-select-option value="" selected>Selecciona una opción</md-select-option>
                            @foreach ($categorias as $categoria)
                                <md-select-option
                                    value="{{ $categoria->id }}">{{ $categoria->nombre }}</md-select-option>
                            @endforeach
                        </md-filled-select>

                        <md-filled-select class="input-uniforme" label="Presentacion" name="presentacion"
                            id="presentacion" onchange="mostrarCamposAdicionales()">
                            <md-select-option value="" selected>Selecciona una opción</md-select-option>
                            @foreach ($presentaciones as $presentacion)
                                <md-select-option value="{{ $presentacion->id }}"
                                    data-categoria="{{ $presentacion->id_categoria }}">{{ $presentacion->nombre }}</md-select-option>
                            @endforeach
                        </md-filled-select>

                        <div id="cantidadCampos">
                            <md-filled-text-field class="input-uniforme" label="Comprimidos por caja" value=""
                                type="number" name="comprimidos_por_caja" min="0" max="999999999"
                                id="cantidad_comprimidos" style="display: none;">
                            </md-filled-text-field>
                            <md-filled-text-field class="input-uniforme" label="Cantidad de ml por unidad"
                                value="" type="number" name="ml_por_unidad" min="0" max="999999999"
                                id="cantidad_ml" style="display: none;">
                            </md-filled-text-field>
                            <md-filled-text-field class="input-uniforme" label="Cantidad de unidades por envase"
                                value="" type="number" name="unidades_por_envase" min="0" max="999999999"
                                id="cantidad_unidades" style="display: none;">
                            </md-filled-text-field>
                            <md-filled-text-field class="input-uniforme" label="Valor fraccionado" value="0"
                                type="number" name="precio_fraccionado" min="0" max="999999999"
                                id="precio_fraccionado" prefix-text="$" style="display: none;">
                            </md-filled-text-field>
                        </div>

                        <md-filled-text-field class="input-uniforme" label="Stock" value="" name="stock_unidades"
                            type="number" min="0" max="999999999" required>
                        </md-filled-text-field>

                        <md-filled-text-field class="input-uniforme" label="Cantidad minima requerida" value=""
                            type="number" min="0" max="999999999" name="cantidad_minima_requerida">
                        </md-filled-text-field>

                        <md-filled-select class="input-uniforme" label="Unidades mg, g, Kg, ml, l" name="unidad">
                            <md-select-option value="" selected>Selecciona una opción</md-select-option>
                            @foreach ($unidades as $unidad)
                                <md-select-option value="{{ $unidad->id }}">{{ $unidad->nombre }}</md-select-option>
                            @endforeach
                        </md-filled-select>

                        <md-filled-text-field class="input-uniforme" label="Precio de compra" value=""
                            type="number" min="0" max="999999999" name="precio_de_compra" required
                            prefix-text="$">
                        </md-filled-text-field>

                        <md-filled-text-field class="input-uniforme" label="Precio de venta" value=""
                            type="number" min="0" max="999999999" name="precio_de_venta" required
                            prefix-text="$">
                        </md-filled-text-field>


                        <md-filled-text-field class="input-uniforme" label="Fecha de Expiración" type="date"
                            name="fecha_de_vencimiento">
                        </md-filled-text-field>

                        <md-filled-text-field class= "input-uniforme" label="Descripcion" value=""
                            name="descripcion">
                        </md-filled-text-field>

                        <label>
                            Mostrar en la web
                            <md-switch name="mostrar_web" id="mostrar_web" value="1"></md-switch>
                        </label>

                    </div>
                    <div id="boton-enviar">
                        <md-fab onclick="submitForm(event)" size="large" label="Agregar Producto">
                            <md-icon slot="icon">save</md-icon>
                        </md-fab>
                    </div>

                    <!-- Contenedor para la alerta -->
                    <div id="alerta-error" class="alert alert-danger" role="alert"
                        style="display: none; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 9999;">
                        El código ingresado ya se encuentra registrado. Por favor, elija otro.
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function filtrarPresentaciones() {
            const categoriaId = document.getElementById('categoria').value;
            const presentacionSelect = document.getElementById('presentacion');
            const opciones = presentacionSelect.querySelectorAll('md-select-option');

            opciones.forEach(opcion => {
                if (opcion.getAttribute('data-categoria') == categoriaId || opcion.value == '') {
                    opcion.style.display = 'block';
                } else {
                    opcion.style.display = 'none';
                }
            });

            // Resetear la selección de presentación
            presentacionSelect.value = '';
            mostrarCamposAdicionales();
        }

        function mostrarCamposAdicionales() {
            const presentacion = document.getElementById('presentacion').value;
            const cantidadComprimidos = document.getElementById('cantidad_comprimidos');
            const cantidadMl = document.getElementById('cantidad_ml');
            const cantidadUnidades = document.getElementById('cantidad_unidades');
            const valorFraccionado = document.getElementById('precio_fraccionado');
            const vendeAGranelField = document.createElement('input');
            vendeAGranelField.type = 'hidden';
            vendeAGranelField.name = 'vende_a_granel';
            vendeAGranelField.id = 'vende_a_granel';
            document.getElementById('formulario-productos').appendChild(vendeAGranelField);

            // Ocultar todos los campos inicialmente
            cantidadComprimidos.style.display = 'none';
            cantidadMl.style.display = 'none';
            cantidadUnidades.style.display = 'none';
            valorFraccionado.style.display = 'none';

            // Mostrar el campo correspondiente según la selección
            if (presentacion == '1') {
                cantidadComprimidos.style.display = 'block';
                valorFraccionado.style.display = 'block';
                vendeAGranelField.value = 0;
            } else if (presentacion == '2') {
                cantidadMl.style.display = 'block';
                valorFraccionado.style.display = 'block';
                vendeAGranelField.value = 0;
            } else if (presentacion == '3') {
                cantidadUnidades.style.display = 'block';
                valorFraccionado.style.display = 'block';
                vendeAGranelField.value = 1;
            } else if (presentacion == '') {
                cantidadComprimidos.style.display = 'none';
                cantidadMl.style.display = 'none';
                cantidadUnidades.style.display = 'none';
                vendeAGranelField.value = 0;
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fechaVencimientoField = document.querySelector('input[name="fecha_de_vencimiento"]');
            const today = new Date().toISOString().split('T')[0];
            const maxDate = new Date('2040-12-31').toISOString().split('T')[0];

            fechaVencimientoField.setAttribute('min', today);
            fechaVencimientoField.setAttribute('max', maxDate);
        });
    </script>

    <script>
        function submitForm(event) {
            event.preventDefault(); // Evita el envío del formulario temporalmente
            const form = document.getElementById('formulario-productos');
            const codigoField = document.getElementById('codigo');
            const codigo = codigoField.value;

            if (codigo) {
                // Generar la URL de la ruta utilizando la función de Blade
                const url = `{{ route('inventario.validarCodigo', ['codigo' => 'CODIGO_PLACEHOLDER']) }}`.replace(
                    'CODIGO_PLACEHOLDER', codigo);

                // Realizar la solicitud AJAX para verificar si el código ya existe
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.existe) {
                            // Mostrar la alerta de error
                            mostrarAlerta();
                            // Marcar el campo como inválido
                            codigoField.setCustomValidity('El código ya existe');
                        } else {
                            // Restablecer la validez si el código es único
                            codigoField.setCustomValidity('');
                            // Si el formulario es válido, enviarlo
                            if (form.checkValidity()) {
                                form.submit();
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error al verificar el código:', error);
                    });
            } else {
                // Si el campo está vacío, restablecer la validez
                codigoField.setCustomValidity('');
                // Verifica si el formulario es válido antes de enviarlo
                if (form.checkValidity()) {
                    form.submit();
                } else {
                    // Si el formulario no es válido, muestra los mensajes de error
                    form.reportValidity();
                }
            }
        }

        function mostrarAlerta() {
            const alerta = document.getElementById('alerta-error');
            alerta.style.display = 'block';

            // Ocultar la alerta después de 5 segundos
            setTimeout(() => {
                alerta.style.display = 'none';
            }, 5000);
        }
    </script>

    <script>
        // Obtener los elementos del DOM
        const openDialogButton = document.getElementById('openDialogButton');
        const deleteDialog = document.getElementById('deleteDialog');
        const cancelButton = document.getElementById('cancelButton');
        const deleteButton = document.getElementById('deleteButton');

        // Abrir el diálogo al hacer clic en el botón
        openDialogButton.addEventListener('click', async () => {
            await deleteDialog.show();
        });

        // Acción al hacer clic en el botón "Cancelar"
        cancelButton.addEventListener('click', async () => {
            await deleteDialog.close();
        });

        // Acción al hacer clic en el botón "Eliminar"
        deleteButton.addEventListener('click', async () => {
            // Aquí puedes añadir la lógica para eliminar el elemento.
            console.log('Item deleted');
            await deleteDialog.close();
        });
    </script>


</x-app-layout>
