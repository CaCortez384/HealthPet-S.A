<x-app-layout>

  <link href="{{ asset('css\crear-producto-style.css') }}" rel="stylesheet">

  <div id="contenedor">
    <div>
        <div id="volver-titulo">
            <md-icon-button id="openDialogButton">
                <md-icon>arrow_back</md-icon>
            </md-icon-button>

            <h6>Editar producto</h6>

            <md-dialog id="deleteDialog" type="alert">
                <div slot="headline">¿Desea volver a la página anterior?</div>
                <form slot="content" id="form-id" method="dialog">
                    Si regresa, los datos no se guardarán.
                </form>
                <div slot="actions">
                    <md-text-button id="cancelButton" value="cancel">Cancel</md-text-button>
                    <a href="javascript:history.back()"><md-text-button value="delete">Volver</md-text-button></a>
                </div>
            </md-dialog>
        </div>

        <md-divider inset></md-divider>

        <div>
            <form action="{{ route('actualizar.producto', $producto->id) }}" method="POST" id="formulario-productos">
                @csrf
                @method('PUT')
                <div id="formulario-crear">

                    <md-filled-text-field label="Nombre del producto" value="{{ $producto->nombre }}" name="nombre" required>
                    </md-filled-text-field>

                    <md-filled-text-field class="input-uniforme" label="Codigo" value="{{ $producto->codigo }}" type="number" name="codigo" min="0" max="999999999" id="codigo" required>
                    </md-filled-text-field>

                    <md-filled-select class="input-uniforme" label="Categoría" name="categoria">
                        @foreach ($categorias as $categoria)
                        <md-select-option value="{{ $categoria->id }}" @if($categoria->id == $producto->id_categoria) selected @endif>
                            {{ $categoria->nombre }}
                        </md-select-option>
                        @endforeach
                    </md-filled-select>
                    
                    <md-filled-select class="input-uniforme" label="Presentacion" name="presentacion" id="presentacion" onchange="mostrarCamposAdicionales()">
                        <md-select-option value="" @if(!$producto->id_presentacion) selected @endif>Selecciona una opción</md-select-option>
                        @foreach ($presentaciones as $presentacion)
                            <md-select-option value="{{ $presentacion->id }}" @if($presentacion->id == $producto->id_presentacion) selected @endif>
                                {{ $presentacion->nombre }}
                            </md-select-option>
                        @endforeach
                    </md-filled-select>
                    
                    <div id="cantidadCampos">
                        <md-filled-text-field class="input-uniforme" label="Comprimidos por caja" value="{{ $producto->comprimidos_por_caja }}" type="number" name="comprimidos_por_caja" min="0" max="999999999" id="cantidad_comprimidos" style="display: none;">
                        </md-filled-text-field>
                        <md-filled-text-field class="input-uniforme" label="Cantidad de ml por unidad" value="{{ $producto->ml_por_unidad }}" type="number" name="ml_por_unidad" min="0" max="999999999" id="cantidad_ml" style="display: none;">
                        </md-filled-text-field>
                        <md-filled-text-field class="input-uniforme" label="Cantidad de unidades por envase" value="{{ $producto->unidades_por_envase }}" type="number" name="unidades_por_envase" min="0" max="999999999" id="cantidad_unidades" style="display: none;">
                        </md-filled-text-field>
                    </div>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            if ({{ $producto->id_presentacion }} == 1) {
                                document.getElementById('cantidad_comprimidos').style.display = 'block';
                            } else if ({{ $producto->id_presentacion }} == 2) {
                                document.getElementById('cantidad_ml').style.display = 'block';
                            } else if ({{ $producto->id_presentacion }} == 3) {
                                document.getElementById('cantidad_unidades').style.display = 'block';
                            }
                        });

                        function mostrarCamposAdicionales() {
                            const presentacion = document.getElementById('presentacion').value;
                            const cantidadComprimidos = document.getElementById('cantidad_comprimidos');
                            const cantidadMl = document.getElementById('cantidad_ml');
                            const cantidadUnidades = document.getElementById('cantidad_unidades');
                            const vendeAGranelField = document.getElementById('vende_a_granel') || document.createElement('input');
                            vendeAGranelField.type = 'hidden';
                            vendeAGranelField.name = 'vende_a_granel';
                            vendeAGranelField.id = 'vende_a_granel';
                            if (!document.getElementById('vende_a_granel')) {
                                document.getElementById('formulario-productos').appendChild(vendeAGranelField);
                            }

                            // Ocultar todos los campos inicialmente
                            cantidadComprimidos.style.display = 'none';
                            cantidadMl.style.display = 'none';
                            cantidadUnidades.style.display = 'none';

                            // Mostrar el campo correspondiente según la selección
                            if (presentacion == '1') {
                                cantidadComprimidos.style.display = 'block';
                                vendeAGranelField.value = 0;
                            } else if (presentacion == '2') {
                                cantidadMl.style.display = 'block';
                                vendeAGranelField.value = 0;
                            } else if (presentacion == '3') {
                                cantidadUnidades.style.display = 'block';
                                vendeAGranelField.value = 1;
                            } else {
                                vendeAGranelField.value = 0;
                            }
                        }

                        // Asegurarse de que los campos ocultos se envíen al controlador
                        document.getElementById('formulario-productos').addEventListener('submit', function() {
                            document.getElementById('cantidad_comprimidos').style.display = 'block';
                            document.getElementById('cantidad_ml').style.display = 'block';
                            document.getElementById('cantidad_unidades').style.display = 'block';
                            const vendeAGranelField = document.getElementById('vende_a_granel');
                            if (!vendeAGranelField.value) {
                                vendeAGranelField.value = 0;
                            }
                        });
                    </script>

                    <md-filled-text-field class="input-uniforme" label="Stock" value="{{ $producto->stock_unidades }}" name="stock_unidades" min="0" max="999999999" type="number" required>
                    </md-filled-text-field>

                    <md-filled-text-field class="input-uniforme" label="Cantidad minima requerida" value="{{ $producto->cantidad_minima_requerida }}" type="number" min="0" max="999999999" name="cantidad_minima_requerida" required>
                    </md-filled-text-field>

                    <md-filled-select class="input-uniforme" label="Unidades mg, g, Kg, ml, L" name="unidad">
                        @foreach ($unidades as $unidad)
                        <md-select-option value="{{ $unidad->id }}" @if($unidad->id == $producto->id_unidad) selected @endif>
                            {{ $unidad->nombre }}
                        </md-select-option>
                        @endforeach
                    </md-filled-select>

                    <md-filled-text-field class="input-uniforme" label="Precio de compra" value="{{ $producto->precio_de_compra }}" type="text" min="0" max="999999999" name="precio_de_compra" required prefix-text="$">
                    </md-filled-text-field>

                    <md-filled-text-field class="input-uniforme" label="Precio de venta" value="{{ $producto->precio_de_venta }}" type="text" min="0" max="999999999" name="precio_de_venta" required prefix-text="$">
                    </md-filled-text-field>

                    <md-filled-select class="input-uniforme" label="Unidades ml, kg, L" name="unidad">
                        @foreach ($unidades as $unidad)
                        <md-select-option value="{{ $unidad->id }}" @if($unidad->id == $producto->id_unidad) selected @endif>
                            {{ $unidad->nombre }}
                        </md-select-option>
                        @endforeach
                    </md-filled-select>

                    <md-filled-text-field class="input-uniforme" label="Fecha de Expiración" value="{{ $producto->fecha_de_vencimiento ? $producto->fecha_de_vencimiento->format('Y-m-d') : '' }}" type="date"   min="2023-12-31" max="2037-12-31"> name="fecha_de_vencimiento" required>
                    </md-filled-text-field>

                    
                </div>
                <div id="boton-enviar">
                    <md-fab onclick="submitForm(event)" size="large" label="Confirmar edición">
                        <md-icon slot="icon">save</md-icon>
                    </md-fab>
                </div>

                <!-- Contenedor para la alerta -->
                <div id="alerta-error" class="alert alert-danger" role="alert" style="display: none; position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 9999;">
                    El código ingresado ya se encuentra registrado. Por favor, elija otro.
                </div>

                <script>
                    function submitForm(event) {
                        event.preventDefault(); // Evita el envío del formulario temporalmente
                        const form = document.getElementById('formulario-productos');
                        const codigoField = document.getElementById('codigo');
                        const codigo = codigoField.value;

                        if (codigo) {
                            // Generar la URL de la ruta utilizando la función de Blade
                            const url = `{{ route('inventario.validarCodigoEdit', ['codigo' => 'CODIGO_PLACEHOLDER', 'id' => $producto->id]) }}`.replace('CODIGO_PLACEHOLDER', codigo);

                            // Realizar la solicitud AJAX para verificar si el código ya existe, excepto para el propio producto
                            fetch(url)
                                .then(response => response.json())
                                .then(data => {
                                    if (data.existe && data.id !== {{ $producto->id }}) {
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
            </form>
        </div>
    </div>
</div>

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
