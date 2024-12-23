<x-app-layout>

    <div>
        @include('components.alert')
        {{-- alerta que muestra cuando un producto se agrego con exito --}}
        @section('content')
        @include('components.alert')
        @endsection

        <div id="contenedor">
            
            <div>
                <h6>Buscar articulo</h6>
            </div>
            {{-- Formulario para busqueda de productos mediante nombre, codigo o categoria --}}
            <div id="menu-busqueda">
                <form action="{{ route('listar.productos') }}" method="GET">
                    <div id="inputs-busqueda">
                        <md-filled-text-field class="input-busqueda" label="Nombre Producto" name="nombre">
                        </md-filled-text-field>

                        <md-filled-text-field class="input-busqueda" label="C&oacute;digo Producto" name="codigo">
                        </md-filled-text-field>
                        <md-filled-select class="input-busqueda" label="Categoría" name="categoria">
                            <md-select-option value="" selected>Selecciona una opción</md-select-option>
                            @foreach ($categorias as $categoria)
                                <md-select-option value="{{ $categoria->id }}"
                                    {{ request('categoria') == $categoria->id ? 'selected' : '' }}>
                                    {{ $categoria->nombre }}
                                </md-select-option>
                            @endforeach
                        </md-filled-select>

                        <div class="input-busqueda">
                            <label for="mostrar_web">Producto web</label>
                            <md-switch id="mostrar_web" name="mostrar_web" value="1" 
                                {{ request('mostrar_web') == '1' ? 'checked' : '' }}>
                            </md-switch>
                        </div>

                        {{-- Botón para buscar un producto --}}
                        <a class="buscar-botons" href="{{ route('listar.productos') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <md-fab label="Buscar">
                                <md-icon slot="icon">search</md-icon>
                            </md-fab>
                        </a>

                        {{-- Botón para limpiar el filtro aplicado --}}
                        <a class="buscar-botons" href="{{ route('listar.productos') }}">
                            <md-fab label="Eliminar filtro">
                                <md-icon slot="icon">delete</md-icon>
                            </md-fab>
                        </a>
                        
                    </div>
                </form>
            </div>

            {{-- en esta seccion se muestran los filtros aplicados anteriormente --}}
            @if ($filtros['nombre'] || $filtros['categoria'] || $filtros['codigo'] || $filtros['mostrar_web'] !== null)
                <div class="filtros-activos">
                    <h5>Filtros Aplicados:</h5>
                    <md-chip-set>
                        @if ($filtros['nombre'])
                            <md-assist-chip>Nombre: "{{ $filtros['nombre'] }}"
                                <md-icon slot="icon">inventory_2</md-icon>
                            </md-assist-chip>
                        @endif
                        @if ($filtros['categoria'])
                            <md-assist-chip>Categoría:
                                "{{ $categorias->firstWhere('id', $filtros['categoria'])->nombre }}"
                                <md-icon slot="icon">category</md-icon>
                            </md-assist-chip>
                        @endif
                        @if ($filtros['codigo'])
                            <md-assist-chip>Código: "{{ $filtros['codigo'] }}"
                                <md-icon slot="icon">barcode_scanner</md-icon>
                            </md-assist-chip>
                        @endif
                        @if ($filtros['mostrar_web'] !== null)
                            <md-assist-chip>Mostrar en Web: "{{ $filtros['mostrar_web'] == '1' ? 'Sí' : 'No' }}"
                                <md-icon slot="icon">public</md-icon>
                            </md-assist-chip>
                        @endif
                    </md-chip-set>
                </div>
            @endif

        </div>

        <div id="contenedor">
            <div id="lista-productos">
                <h6>Listado de productos</h6>
                {{-- Botón para agregar un nuevo producto --}}
                <a href="{{ route('inventario.crear') }}">
                    <md-fab label="Agregar">
                        <md-icon slot="icon">add</md-icon>
                    </md-fab>
                </a>
            </div>

            <!-- Tabla para listar productos -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Producto</th>
                        <th scope="col">Código</th>
                        <th scope="col">Precio de venta</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Presentación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- recorrer todos los productos --}}
                    @forelse($productos as $producto)
                        <tr>
                            <th scope="row">
                                {{ $producto->nombre }}
                                @if ($producto->mostrar_web)
                                    <md-icon>public</md-icon>
                                @endif
                            </th>
                            <td>{{ $producto->codigo }}</td>
                            <td><strong>$</strong>{{ $producto->precio_de_venta }}</td>
                            <td>{{ $producto->stock_unidades }}</td>
                            <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                            <td>{{ $producto->presentacion->nombre ?? 'Sin presentación' }}</td>
                            


                            <td>
                                <a href="{{ route('detalle2.producto', ['id' => $producto->id]) }}">
                                    <md-fab size="small" aria-label="View">
                                        <md-icon slot="icon">visibility</md-icon>
                                    </md-fab>
                                </a>
            
                                <!-- Botón para dialogo alerta eliminar -->
                                <a id="openDialogButton_{{ $producto->id }}">
                                    <md-fab class="boton-tabla" size="small" aria-label="Delete">
                                        <md-icon slot="icon">delete</md-icon>
                                    </md-fab>
                                </a>
                                <!-- Diálogo alerta para eliminar producto -->
                                <md-dialog id="dialog_{{ $producto->id }}">
                                    <div slot="headline">
                                        Eliminar Producto "{{ $producto->nombre }}"
                                    </div>
                                    <form slot="content" id="form-id-{{ $producto->id }}" method="POST"
                                        action="{{ route('eliminar.producto', $producto->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        ¿Está seguro que desea eliminar el producto?
                                    </form>
                                    <div slot="actions">
                                        <md-text-button id="closeButton_{{ $producto->id }}">Cancelar</md-text-button>
            
                                        {{-- Botón para confirmar la eliminación del producto --}}
                                        <md-text-button type="submit"
                                            form="form-id-{{ $producto->id }}">Eliminar</md-text-button>
                                    </div>
                                </md-dialog>
                            </td>
                        </tr>
                        {{-- valida si se encontraron productos --}}
                    @empty
                        <tr>
                            <td colspan="7">No se encontraron productos con los filtros aplicados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{-- Enlaces de paginación --}}
            <div class="pagination" >
                {{ $productos->links() }} <!-- Agrega enlaces de paginación aquí -->
            </div>
            
        </div>


        <script>
            document.addEventListener('DOMContentLoaded', () => {
                @foreach ($productos as $producto)
                    // Obtener el botón y el diálogo con el id específico del producto
                    const openDialogButton_{{ $producto->id }} = document.getElementById(
                        'openDialogButton_{{ $producto->id }}');
                    const dialog_{{ $producto->id }} = document.getElementById('dialog_{{ $producto->id }}');
                    const closeButton_{{ $producto->id }} = document.getElementById(
                        'closeButton_{{ $producto->id }}');

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
