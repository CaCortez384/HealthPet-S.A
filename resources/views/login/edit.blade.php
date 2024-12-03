
{{-- /////////////////////////////////////////////////////////////////////////////////////////// --}}

<x-app-layout>

    @include('components.alert')

    <link href="{{ asset('css\crear-producto-style.css') }}" rel="stylesheet">

    <div id="contenedor">
        <div>
            <div id="volver-titulo">
                <md-icon-button id="openDialogButton">
                    <md-icon>arrow_back</md-icon>
                </md-icon-button>
  
                <h6>Editar Usuario</h6>
  
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
                <form action="{{ route('usuarios.update', $user->id) }}" method="POST" id="userForm">
                    @csrf
                    @method('PUT')
        
                    <div id="formulario-crear">
                        <md-filled-text-field class="input-uniforme" type="text" label="Nombre Usuario" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        </md-filled-text-field>

                        <md-filled-text-field class="input-uniforme" label="Correo Electrónico"  type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        </md-filled-text-field>

                        <md-filled-select value="{{ old('role', $user->role) }}" class="input-uniforme" class="form-control" id="role" name="role" required>
                            <md-select-option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Usuario</md-select-option>
                            <md-select-option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrador</md-select-option>
                        </md-filled-select>

                        <div id="contrasenas">
                            <md-filled-text-field  type="password" id="password" name="password" supporting-text="Dejar en blanco para mantener contrase&ntilde;a">
                            </md-filled-text-field>

                            <md-filled-text-field type="password" id="password_confirmation" name="password_confirmation" supporting-text="volver a escribir nueva contrase&ntilde;a para validar ">
                            </md-filled-text-field>
                        </div>
                    </div>

                    <div id="boton-enviar">
                        <md-fab onclick="submitForm(event)" size="large" label="Confirmar edición">
                            <md-icon slot="icon">save</md-icon>
                        </md-fab>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function submitForm(event) {
            event.preventDefault();  // Prevenir el envío automático del formulario

            // Obtener los valores de los campos de contraseña
            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            // Verificar si las contraseñas no coinciden
            if (password !== passwordConfirmation) {
                alert('Las contraseñas no coinciden. Por favor, verifica.');
                return;  // No enviar el formulario si las contraseñas no coinciden
            }

            // Si las contraseñas coinciden o no se cambian, enviar el formulario
            document.getElementById('userForm').submit();
        }

        // Script para manejar el diálogo de volver atrás
        const openDialogButton = document.getElementById('openDialogButton');
        const deleteDialog = document.getElementById('deleteDialog');
        const cancelButton = document.getElementById('cancelButton');

        openDialogButton.addEventListener('click', async () => {
            await deleteDialog.show();
        });

        cancelButton.addEventListener('click', async () => {
            await deleteDialog.close();
        });
    </script>
</x-app-layout>