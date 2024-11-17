<x-home>


    <style>
        #fondo {
            background-image: url('{{ asset('img/listo_fondo.png') }}');
            /* O usando la ruta directa */
            height: 80vh;
            /* Ajusta la altura al 100% de la ventana */
            background-size: cover;
            /* La imagen cubrirá todo el contenedor */

            background-repeat: no-repeat;
            /* Evita que la imagen se repita */
        }

        @media (max-width: 1000px) {

            #fondo {
                background-image: url('{{ asset('img/listo_fondo.png') }}');
                /* O usando la ruta directa */
                height: 100vh;
                /* Ajusta la altura al 100% de la ventana */
                background-size: cover;
                /* La imagen cubrirá todo el contenedor */
                background-position: center;
                /* Centra la imagen */
                background-repeat: no-repeat;
                /* Evita que la imagen se repita */
            }
        }
    </style>
    @auth
        {{-- Si el usuario está autenticado, redirigir a la página principal --}}
        <script type="text/javascript">
            window.location = "{{ route('welcome') }}";
        </script>
    @endauth

    <div id="fondo">
        <script src="https://esm.run/@material/web/all.js" type="module"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Sharp" rel="stylesheet">
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
        <link href="{{ asset('css\login-style.css') }}" rel="stylesheet">

        <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
        <link rel="stylesheet"
            href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">


        <div id="modal">

            @include('components.alert')


            {{-- alerta que muestra cuando un producto se agrego con exito --}}
            @section('content')
                @include('components.alert')

                <!-- Resto del contenido de la página -->
            @endsection
            <div id="logo">

                <img src="img\logo-vet.png" alt="logo" width="100px">
                <h5>Inicia Sesi&oacute;n</h5>

            </div>

            <form action="{{ route('iniciar-sesion') }}" method="POST" id="form">
                @csrf

                <div class="contenedor-input">
                    <md-filled-text-field label="Email" type="email" name="email" required>
                        <md-icon slot="trailing-icon">email</md-icon>
                    </md-filled-text-field>
                </div>

                <div class="contenedor-input">
                    <md-filled-text-field label="Contrase&ntilde;a" type="password" name="password" id="password"
                        required>
                        <md-icon-button id="togglePassword" toggle slot="trailing-icon"
                            aria-label="Mostrar/Ocultar Contraseña">
                            <md-icon id="toggleIcon">visibility</md-icon>
                            <md-icon slot="selected">visibility_off</md-icon>
                        </md-icon-button>
                    </md-filled-text-field>
                </div>

                <div style="display: flex; align-items: center;">
                    <md-checkbox id="checkbox-two" touch-target="wrapper" name="remember"></md-checkbox>
                    <label for="checkbox-two">Recordar</label>
                </div>

                <a id="registrar-a" href="{{ route('password.request') }}">
                    {{ __('Olvidaste tu contraseña?') }}
                </a>


                <p>¿No tienes cuenta? <a id="registrar-a" href="{{ route('registro') }}">Ir a registro</a></p>

                <a class="buscar-botons" href="#" onclick="event.preventDefault(); validateAndSubmit();">
                    <md-fab label="Iniciar sesi&oacute;n">
                        <md-icon slot="icon">login</md-icon>
                    </md-fab>
                </a>
            </form>
        </div>

        <script>
            // Obtener los elementos necesarios
            const togglePassword = document.getElementById('togglePassword');
            const passwordField = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            // Añadir un listener al botón de mostrar/ocultar contraseña
            togglePassword.addEventListener('click', function(event) {
                // Prevenir que el formulario se envíe al hacer clic en el botón
                event.preventDefault();

                // Cambiar el tipo de campo
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);

                // Cambiar el ícono visual
                toggleIcon.textContent = type === 'password' ? 'visibility' : 'visibility_off';
            });


            function validateAndSubmit() {
                const form = document.getElementById('form');
                // Comprueba si el formulario es válido
                if (form.checkValidity()) {
                    form.submit(); // Si es válido, envía el formulario
                } else {
                    // Si no es válido, muestra un mensaje o activa la validación
                    // Esto es opcional, solo para dar retroalimentación al usuario
                    form.reportValidity(); // Esto mostrará un mensaje de error nativo
                }
            }
        </script>



    </div>
</x-home>
