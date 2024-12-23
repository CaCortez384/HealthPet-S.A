<x-app-layout>
   
  
    <link href="{{ asset('css\registrar-admin-style.css') }}" rel="stylesheet">


    <script src="https://esm.run/@material/web/all.js" type="module"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Sharp" rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />



    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
    <link rel="stylesheet"
        href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">







        <div id="contenedor">


          
            @include('components.alert')


            {{-- alerta que muestra cuando un producto se agrego con exito --}}
            @section('content')
                @include('components.alert')

                <!-- Resto del contenido de la página -->
            @endsection


                <div id="volver-titulo">

                    <md-icon-button id="openDialogButton">
                        <md-icon>arrow_back</md-icon>
                    </md-icon-button>
    
                    <h6>Registrar Administrador</h6>
    
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



            <form action="{{ route('validar-regitro-admin') }}" method="POST" id="form">
                @csrf

                <div class="contenedor-input">
                    <md-filled-text-field label="Nombre Usuario" type="text" name="name"
                        supporting-text="Ejemplo: Juanito Perez" required>
                        <md-icon slot="trailing-icon">account_circle</md-icon>
                    </md-filled-text-field>
                </div>

                <div class="contenedor-input">
                    <md-filled-text-field label="Email" type="email" name="email"
                        supporting-text="Ejemplo: correo@mail.com" required>
                        <md-icon slot="trailing-icon">email</md-icon>
                    </md-filled-text-field>
                </div>

                <div class="contenedor-input">
                    <md-filled-text-field label="Contrase&ntilde;a" type="password" name="password" id="password"
                        supporting-text="Mínimo 4 caracteres" required>
                        <md-icon-button id="togglePassword" toggle slot="trailing-icon"
                            aria-label="Mostrar/Ocultar Contraseña">
                            <md-icon id="toggleIcon">visibility</md-icon>
                            <md-icon slot="selected">visibility_off</md-icon>
                        </md-icon-button>
                    </md-filled-text-field>
                </div>

                <div class="contenedor-input">
                    <md-filled-text-field label="Confirmar Contrase&ntilde;a" type="password" name="confirm_password"
                        id="confirmPassword" required>
                        <md-icon-button id="toggleConfirmPassword" toggle slot="trailing-icon"
                            aria-label="Mostrar/Ocultar Contraseña">
                            <md-icon id="toggleConfirmIcon">visibility</md-icon>
                            <md-icon slot="selected">visibility_off</md-icon>
                        </md-icon-button>
                    </md-filled-text-field>
                </div>

                <!-- Contenedor para el mensaje de error de contraseñas no coincidentes -->
                <div id="passwordError" class="error-message" style="color: rgb(180, 6, 6); display: none;">
                    <p>Las contraseñas no coinciden.</hp>
                </div>

                <a class="buscar-botons" href="#" onclick="event.preventDefault(); validateAndSubmit();">
                    <md-fab label="Reg&iacute;strarse">
                        <md-icon slot="icon">how_to_reg</md-icon>
                    </md-fab>
                </a>
            </form>

        </div>

        <script>
            // Obtener los elementos necesarios para mostrar/ocultar la contraseña
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            // Añadir un listener al botón de mostrar/ocultar contraseña
            togglePassword.addEventListener('click', function(event) {
                event.preventDefault();
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                toggleIcon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
            });

            // Mostrar/ocultar contraseña de confirmación
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const confirmPasswordField = document.getElementById('confirmPassword');
            const toggleConfirmIcon = document.getElementById('toggleConfirmIcon');

            toggleConfirmPassword.addEventListener('click', function(event) {
                event.preventDefault();
                const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordField.setAttribute('type', type);
                toggleConfirmIcon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
            });

            function validateAndSubmit() {
                const form = document.getElementById('form');
                const password = passwordField.value;
                const confirmPassword = confirmPasswordField.value;
                const passwordError = document.getElementById('passwordError');

                // Verificar si las contraseñas coinciden
                if (password !== confirmPassword) {
                    passwordError.style.display = 'block'; // Mostrar el mensaje de error
                    return; // No enviar el formulario
                } else {
                    passwordError.style.display = 'none'; // Ocultar el mensaje de error si coincide
                }

                // Comprueba si el formulario es válido
                if (form.checkValidity()) {
                    form.submit(); // Si es válido y las contraseñas coinciden, envía el formulario
                } else {
                    form.reportValidity(); // Muestra un mensaje de error nativo
                }
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
