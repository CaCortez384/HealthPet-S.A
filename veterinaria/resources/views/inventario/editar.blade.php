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

              <form action="{{ route('actualizar.producto', $producto->id) }}" method="POST" id="formulario-productos">

                  @csrf

                  @method('PUT')
                  <div id="formulario-crear">

                      <md-filled-text-field label="Nombre del producto" value="{{$producto->nombre}}" name="nombre" required>
                      </md-filled-text-field>

                        <md-filled-select class="input-busqueda" label="Categoría" name="categoria">
                          @foreach ($categorias as $categoria)
                            <md-select-option value="{{ $categoria->id }}" 
                              @if($categoria->id == $producto->id_categoria) selected @endif>
                              {{ $categoria->nombre }}
                            </md-select-option>
                          @endforeach
                        </md-filled-select>

                      <md-filled-text-field label="Codigo" value="{{$producto->codigo}}" type="number" name="codigo">
                      </md-filled-text-field>

                      <md-filled-text-field label="Precio de compra" value="{{$producto->precio_de_compra}}" type="number"
                          name="precio_de_compra" required prefix-text="$">

                      </md-filled-text-field>

                      <md-filled-text-field label="Precio de venta" value="{{$producto->precio_de_venta}}" type="number"
                          name="precio_de_venta" required prefix-text="$">
                      </md-filled-text-field>

                        <md-filled-select class="input-busqueda" label="Unidades ml, kg, L" name="unidad">
                          @foreach ($unidades as $unidad)
                            <md-select-option value="{{ $unidad->id }}" 
                              @if($unidad->id == $producto->id_unidad) selected @endif>
                              {{ $unidad->nombre }}
                            </md-select-option>
                          @endforeach
                        </md-filled-select>

                      <md-filled-text-field label="Stock" value="{{$producto->stock}}" name="stock" type="number" required>
                      </md-filled-text-field>

                        <md-filled-text-field label="Fecha de Expiración" value="{{ $producto->fecha_de_vencimiento ? $producto->fecha_de_vencimiento->format('Y-m-d') : '' }}" type="date"
                          name="fecha_de_vencimiento" required>
                        </md-filled-text-field>

                      <md-filled-text-field label="Cantidad minima requerida" value="{{$producto->cantidad_minima_requerida}}" type="number"
                          name="cantidad_minima_requerida" required>
                      </md-filled-text-field>
                  </div>
                  <div id="boton-enviar">
                      <md-fab onclick="submitForm()" size="large" label="Confirmar edicion">
                          <md-icon slot="icon">save</md-icon>
                      </md-fab>
                  </div>



                  <script>
                      function submitForm() {
                          const form = document.getElementById('formulario-productos');

                          // Verifica si el formulario es válido antes de enviarlo
                          if (form.checkValidity()) {
                              form.submit();
                          } else {
                              // Si el formulario no es válido, muestra los mensajes de error
                              form.reportValidity();
                          }
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
