<x-app-layout>


    <div >
        @include('components.alert')
        {{-- alerta que muestra cuando un usuario se agregó con éxito --}}
        @section('content')
        @include('components.alert')
        @endsection


        <div id="contenedor">
            
            <div>
                <h6>Buscar usuario</h6>
            </div>
            {{-- Formulario para búsqueda de usuarios mediante nombre, correo o rol --}}
            <div id="menu-busqueda">
                <form action="{{ route('listar.usuarios') }}" method="GET">
                    <div id="inputs-busqueda">
                        <md-filled-text-field class="input-busqueda" label="Nombre Usuario" name="nombre">
                        </md-filled-text-field>

                        <md-filled-text-field class="input-busqueda" label="Correo Usuario" name="correo">
                        </md-filled-text-field>
                        <md-filled-select class="input-busqueda" label="Rol" name="role">
                            <md-select-option value="" selected>Selecciona una opción</md-select-option>
                     
                                <md-select-option value="user">
                                    Usuario
                                </md-select-option>
                                <md-select-option value="admin">
                                    Administrador
                                </md-select-option>
                                
                        </md-filled-select>

                        {{-- Botón para buscar un usuario --}}
                        <a class="buscar-botons" href="{{ route('listar.usuarios') }}"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            <md-fab label="Buscar">
                                <md-icon slot="icon">search</md-icon>
                            </md-fab>
                        </a>

                        {{-- Botón para limpiar el filtro aplicado --}}
                        <a class="buscar-botons" href="{{ route('listar.usuarios') }}">
                            <md-fab label="Eliminar filtro">
                                <md-icon slot="icon">delete</md-icon>
                            </md-fab>
                        </a>
                        
                    </div>
                </form>
            </div>

            {{-- en esta sección se muestran los filtros aplicados anteriormente --}}
            @if ($filtros['nombre'] || $filtros['role'] || $filtros['correo']) <!-- Cambiar 'name' a 'nombre' -->
                <div class="filtros-activos">
                    <h5>Filtros Aplicados:</h5>
                    <md-chip-set>
                        @if ($filtros['nombre'])
                            <md-assist-chip>Nombre: "{{ $filtros['nombre'] }}"
                                <md-icon slot="icon">person</md-icon>
                            </md-assist-chip>
                        @endif
                        @if ($filtros['role'])
                            <md-assist-chip>Rol: "{{ $filtros['role']}}"
                                <md-icon slot="icon">badge</md-icon>
                            </md-assist-chip>
                        @endif
                        @if ($filtros['correo'])
                            <md-assist-chip>Correo: "{{ $filtros['correo'] }}"
                                <md-icon slot="icon">email</md-icon>
                            </md-assist-chip>
                        @endif
                    </md-chip-set>
                </div>
            @endif

        </div>

        <div id="contenedor">
            <div id="lista-usuarios">

                <h6>Listado de usuarios</h6>
                {{-- Botón para agregar un nuevo usuario --}}

                    <a href="{{ route('registro-admin') }}">
                        <md-fab label="Registrar Nuevo Administrador">
                            <md-icon slot="icon">add</md-icon>
                        </md-fab>
                    </a>

      

            </div>

            <!-- Tabla para listar usuarios -->
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Fecha de Registro</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- recorrer todos los usuarios --}}
                    @forelse($usuarios as $usuario)
                        <tr>
                            <th scope="row">
                                {{ $usuario->name }}
                            </th>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->role}}</td>
                            <td>{{ $usuario->created_at->format('d/m/Y') }}</td>

                            <td>
                                <a href="#">
                                    <md-fab size="small" aria-label="View">
                                        <md-icon slot="icon">visibility</md-icon>
                                    </md-fab>
                                </a>

                                <!-- Botón para diálogo alerta eliminar -->
                                <a id="openDialogButton_{{ $usuario->id }}">
                                    <md-fab class="boton-tabla" size="small" aria-label="Delete">
                                        <md-icon slot="icon">delete</md-icon>
                                    </md-fab>
                                </a>
                                <!-- Diálogo alerta para eliminar usuario -->
                                <md-dialog id="dialog_{{ $usuario->id }}">
                                    <div slot="headline">
                                        Eliminar Usuario "{{ $usuario->name }}"
                                    </div>
                                    <form slot="content" action="{{ route('usuarios.destroy', $usuario->id) }}" id="form-id-{{ $usuario->id }}" method="POST"
                                       >
                                        @csrf
                                        @method('DELETE')
                                        ¿Está seguro que desea eliminar el usuario?
                                    </form>
                                    <div slot="actions">
                                        <md-text-button id="closeButton_{{ $usuario->id }}">Cancelar</md-text-button>
            
                                        {{-- Botón para confirmar la eliminación del usuario --}}
                                        <md-text-button type="submit"
                                            form="form-id-{{ $usuario->id }}">Eliminar</md-text-button>
                                    </div>
                                </md-dialog>
                            </td>
                        </tr>
                        {{-- valida si se encontraron usuarios --}}
                    @empty
                        <tr>
                            <td colspan="5">No se encontraron usuarios con los filtros aplicados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            
            {{-- Enlaces de paginación --}}
            <div class="pagination" >
                {{ $usuarios->links() }} <!-- Agrega enlaces de paginación aquí -->
            </div>
            
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                @foreach ($usuarios as $usuario)
                    // Obtener el botón y el diálogo con el id específico del producto
                    const openDialogButton_{{ $usuario->id }} = document.getElementById(
                        'openDialogButton_{{ $usuario->id }}');
                    const dialog_{{ $usuario->id }} = document.getElementById('dialog_{{ $usuario->id }}');
                    const closeButton_{{ $usuario->id }} = document.getElementById(
                        'closeButton_{{ $usuario->id }}');

                    // Añadir el evento para abrir el diálogo
                    openDialogButton_{{ $usuario->id }}.addEventListener('click', async () => {
                        await dialog_{{ $usuario->id }}.show(); // Abre el diálogo correspondiente
                    });

                    // Añadir el evento para cerrar el diálogo
                    closeButton_{{ $usuario->id }}.addEventListener('click', async () => {
                        await dialog_{{ $usuario->id }}.close(); // Cierra el diálogo correspondiente
                    });
                @endforeach
            });


         
        </script>

    </div>
</x-app-layout>
