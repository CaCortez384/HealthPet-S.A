<x-app-layout>

  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@material/web@latest/md-filled-select/md-filled-select.min.css">
<link href="{{ asset('css\lista-productos-style.css') }}"  rel="stylesheet" >  


  <div>

    <div id="contenedor" >

        
          <div>
            <h6>Buscar articulo</h6>
          </div>

          

{{-- Recordar asignarle el name a los inputs para realizar la consulta. --}}
<div id="menu-busqueda" >
          <div id="inputs-busqueda">

            <md-filled-text-field class="input-busqueda" label="Nombre Producto" name="" >
            </md-filled-text-field>

            <md-filled-text-field class="input-busqueda"  label="C&oacute;digo Producto" name="" >
            </md-filled-text-field>

          <md-filled-select class="input-busqueda"  label="Categoría" >
            
          
                <option value=""  selected>Selecciona una opción</option>
                <option value="volvo">Volvo</option>
                <option value="saab">Saab</option>
                <option value="mercedes">Mercedes</option>
                <option value="audi">Audi</option>
            </select>
        </md-filled-select>


  

          </div>

          <md-fab label="buscar">
            <md-icon slot="icon">search</md-icon>
          </md-fab>

        </div>

    </div>


        <div id="contenedor">

          <div id="lista-productos" > 

          <h6>Listado de productos</h6>


            <a href="./inventario/crear">
          <md-fab label="agregar">
            <md-icon slot="icon">add</md-icon>
          </md-fab>
        </a>

        </div>


          <table class="table" >

              <thead>
                <tr>
                  <th scope="col">Producto</th>
                  <th scope="col">Codigo</th>
                  <th scope="col">Precio de compra</th>
                  <th scope="col">Precio de venta</th>
                  <th scope="col">Cantidad</th>
                  <th scope="col">Categoria</th>
                  <th scope="col">Acciones</th>
                </tr>
              </thead>
            </thead>

            <tbody>
              @foreach ($productos as $producto)
                <tr>
                  <th scope="row">{{ $producto->nombre }}</th>
                  <td>{{ $producto->codigo }}</td>
                  <td><strong>$</strong>{{ $producto->precio_de_compra }}</td>
                  <td><strong>$</strong>{{ $producto->precio_de_venta }}</td>
                  <td>{{ $producto->stock }}</td>
                  <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                  <td>
                    <a href="/inventario/editar">
                      <md-fab size="small" aria-label="Edit">
                        <md-icon slot="icon">edit</md-icon>
                      </md-fab>
                    </a>
            <!-- Botón para dialogo alerta eliminar -->
                    <a id="openDialogButton_{{ $producto->id }}">
                      <md-fab class="boton-tabla" size="small" aria-label="Delete">
                        <md-icon slot="icon">delete</md-icon>
                      </md-fab>
                    </a>
            

            
                    <!-- Diálogo alerta para eliminar producto -->
                    <md-dialog id="dialog_{{ $producto->id }}" >
                      <div slot="headline">
                        Eliminar Producto "{{ $producto->nombre }}"
                      </div>
                      <form slot="content" id="form-id-{{ $producto->id }}" method="dialog">
                        ¿Esta seguro que desea eliminar el producto?
                      </form>
                      <div slot="actions">
                        <md-text-button id="closeButton_{{ $producto->id }}" form="form-id-{{ $producto->id }}">Cancelar</md-text-button>

                        {{-- Asignarle la funcion al boton para eliminar producto --}}
                        <md-text-button id="closeButton_{{ $producto->id }}" form="form-id-{{ $producto->id }}">Eliminar</md-text-button>
                      </div>
                    </md-dialog>
            
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
  
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', () => {
            @foreach ($productos as $producto)
              // Obtener el botón y el diálogo con el id específico del producto
              const openDialogButton_{{ $producto->id }} = document.getElementById('openDialogButton_{{ $producto->id }}');
              const dialog_{{ $producto->id }} = document.getElementById('dialog_{{ $producto->id }}');
              const closeButton_{{ $producto->id }} = document.getElementById('closeButton_{{ $producto->id }}');
        
              // Añadir el evento para abrir el diálogo
              openDialogButton_{{ $producto->id }}.addEventListener('click', async () => {
                await dialog_{{ $producto->id }}.show(); // Abre el diálogo correspondiente
              });
        
              // Añadir el evento para cerrar el diálogo
              closeButton_{{ $producto->id }}.addEventListener('click', async () => {
                await dialog_{{ $producto->id }}.close(); // Cierra el diálogo correspondiente
              });
            @endforeach
          });
        </script>


</div>
</x-app-layout>    
