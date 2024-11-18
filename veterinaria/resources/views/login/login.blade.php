<x-home>


@auth
    {{-- Si el usuario está autenticado, redirigir a la página principal --}}
    <script type="text/javascript">
        window.location = "{{ route('welcome') }}";
    </script>
@endauth

<div id="fondo">
    <script src="https://esm.run/@material/web/all.js" type="module"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="{{ asset('css\login-style.css') }}" rel="stylesheet">
    
<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">

<style>
    #modal{
            position: relative;
            background-image: url('{{ asset('img/clientes/fondo-cliente.png') }}');
        
    }

    .inputContainer input:hover {
            cursor: url('{{ asset('img/cursor-gato-hover.png') }}'), auto;
        }
</style>
<div id="modal">


   
        <div class="husky">
            <div class="mane">
              <div class="coat"></div>
            </div>
            <div class="body">
              <div class="head">
                <div class="ear"></div>
                <div class="ear"></div>
                <div class="face">
                  <div class="eye"></div>
                  <div class="eye"></div>
                  <div class="nose"></div>
                  <div class="mouth">
                    <div class="lips"></div>
                    <div class="tongue"></div>
                  </div>
                </div>
              </div>
              <div class="torso"></div>
            </div>
            <div class="legs">
              <div class="front-legs">
                <div class="leg"></div>
                <div class="leg"></div>
              </div>
              <div class="hind-leg">
              </div>
            </div>
            <div class="tail">
              <div class="tail">
                <div class="tail">
                  <div class="tail">
                    <div class="tail">
                      <div class="tail">
                        <div class="tail"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
           
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="display:none">
            <defs>
           
              
              <filter id="squiggly-0">
                <feTurbulence id="turbulence" baseFrequency="0.02" numOctaves="3" result="noise" seed="0"/>
                <feDisplacementMap id="displacement" in="SourceGraphic" in2="noise" scale="2" />
              </filter>
              <filter id="squiggly-1">
                <feTurbulence id="turbulence" baseFrequency="0.02" numOctaves="3" result="noise" seed="1"/>
          <feDisplacementMap in="SourceGraphic" in2="noise" scale="3" />
              </filter>
              
              <filter id="squiggly-2">
                <feTurbulence id="turbulence" baseFrequency="0.02" numOctaves="3" result="noise" seed="2"/>
          <feDisplacementMap in="SourceGraphic" in2="noise" scale="2" />
              </filter>
              <filter id="squiggly-3">
                <feTurbulence id="turbulence" baseFrequency="0.02" numOctaves="3" result="noise" seed="3"/>
          <feDisplacementMap in="SourceGraphic" in2="noise" scale="3" />
              </filter>
              
              <filter id="squiggly-4">
                <feTurbulence id="turbulence" baseFrequency="0.02" numOctaves="3" result="noise" seed="4"/>
          <feDisplacementMap in="SourceGraphic" in2="noise" scale="1" />
              </filter>
            </defs> 
          </svg>
 

    @include('components.alert')


    {{-- alerta que muestra cuando un producto se agrego con exito --}}
    @section('content')
    @include('components.alert')

    <!-- Resto del contenido de la página -->
@endsection
{{-- 
<form action="{{ route('iniciar-sesion') }}" method="POST" id="form">
    @csrf

    <div class="contenedor-input">
        <md-filled-text-field label="Email" type="email" name="email" required>
            <md-icon slot="trailing-icon">email</md-icon>
        </md-filled-text-field>
    </div>

    <div class="contenedor-input">
        <md-filled-text-field label="Contrase&ntilde;a" type="password" name="password" id="password" required>
            <md-icon-button id="togglePassword" toggle slot="trailing-icon" aria-label="Mostrar/Ocultar Contraseña">
                <md-icon id="toggleIcon">visibility</md-icon>
                <md-icon slot="selected">visibility_off</md-icon>
            </md-icon-button>
        </md-filled-text-field>
    </div>

    <div style="display: flex; align-items: center;">
        <md-checkbox id="checkbox-two" touch-target="wrapper" name="remember"></md-checkbox>
        <label for="checkbox-two">Recordar</label>
    </div>

    <a id="registrar-a"   href="{{ route('password.request') }}">
        {{ __('Olvidaste tu contraseña?') }}
    </a>


    <p>¿No tienes cuenta? <a id="registrar-a"  href="{{ route('registro') }}">Ir a registro</a></p>

    <a class="buscar-botons" href="#" onclick="event.preventDefault(); validateAndSubmit();">
        <md-fab label="Iniciar sesi&oacute;n">
            <md-icon slot="icon">login</md-icon>
        </md-fab>
    </a>
</form> --}}

<form action="{{ route('iniciar-sesion') }}" method="POST" id="form"  class="form_main">
    @csrf
    <div style="display: flex; align-items: center">    <p class="heading">Login</p><i class="fa-solid fa-paw" id="patita"></i></div>

    <div class="inputContainer">
        <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#2e2e2e" viewBox="0 0 16 16">
        <path d="M13.106 7.222c0-2.967-2.249-5.032-5.482-5.032-3.35 0-5.646 2.318-5.646 5.702 0 3.493 2.235 5.708 5.762 5.708.862 0 1.689-.123 2.304-.335v-.862c-.43.199-1.354.328-2.29.328-2.926 0-4.813-1.88-4.813-4.798 0-2.844 1.921-4.881 4.594-4.881 2.735 0 4.608 1.688 4.608 4.156 0 1.682-.554 2.769-1.416 2.769-.492 0-.772-.28-.772-.76V5.206H8.923v.834h-.11c-.266-.595-.881-.964-1.6-.964-1.4 0-2.378 1.162-2.378 2.823 0 1.737.957 2.906 2.379 2.906.8 0 1.415-.39 1.709-1.087h.11c.081.67.703 1.148 1.503 1.148 1.572 0 2.57-1.415 2.57-3.643zm-7.177.704c0-1.197.54-1.907 1.456-1.907.93 0 1.524.738 1.524 1.907S8.308 9.84 7.371 9.84c-.895 0-1.442-.725-1.442-1.914z"></path>
        </svg>
    <input class="inputField" id="username" placeholder="Email" type="email" name="email" required>
    </div>
    
    <div class="inputContainer" id="pass">
        <svg class="inputIcon" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 16 16" fill="#2e2e2e">
            <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"></path>
        </svg>
        <input class="inputField" placeholder="Contraseña" type="password" name="password" id="password" required>
        <div class="fakePassword" id="fakePassword"></div>
        <i class="fa-solid fa-eye-slash" id="togglePassword"></i>
    </div>

<div style="display: flex; align-items: center;" id="sobre">
    <md-checkbox id="checkbox-two" touch-target="wrapper" name="remember"></md-checkbox>
    <label for="checkbox-two">Recordar</label>
</div>
              
           
<button id="button" onclick="event.preventDefault(); validateAndSubmit();">Iniciar sesi&oacute;n</button>

<a class="forgotLink"  href="{{ route('password.request') }}">
    {{ __('Olvidaste tu contraseña?') }}
</a>
    <p id="sobre"> ¿No tienes cuenta? <a id="registrar-a"  href="{{ route('registro') }}">Ir a registro</a></p>
</form>

</div>

<script>

const passwordInput = document.getElementById('password');
        const fakePassword = document.getElementById('fakePassword');
        const togglePassword = document.getElementById('togglePassword');

        // Actualizar los íconos de la contraseña según la longitud
        passwordInput.addEventListener('input', () => {
            const length = passwordInput.value.length;
            fakePassword.innerHTML = Array(length).fill('<i class="fa-solid fa-paw"></i>').join('');
        });

        // Alternar entre mostrar y ocultar contraseña
        togglePassword.addEventListener('click', () => {
            const isPassword = passwordInput.type === 'password';
            passwordInput.type = isPassword ? 'text' : 'password';

            // Mostrar o esconder los íconos
            fakePassword.style.display = isPassword ? 'none' : 'flex';

            // Cambiar el ícono del botón
            togglePassword.classList.toggle('fa-eye-slash');
            togglePassword.classList.toggle('fa-eye');

                // Cambiar el color del texto real
    passwordInput.style.color = isPassword ? 'black' : 'transparent';
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