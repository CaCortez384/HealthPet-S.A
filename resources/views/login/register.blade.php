<x-home>

    <style>
        .contenedor-registro{
                position: relative;
                background-image: url('{{ asset('img/fondo-registro.png') }}');
            
        }
    
        .inputContainer input:hover {
                cursor: url('{{ asset('img/cursor-gato-hover.png') }}'), auto;
            }
    </style>
<link href="{{ asset('scss/registro-user.scss') }}" rel="stylesheet">
<link href="{{ asset('css\boton-sucess-style.css') }}" rel="stylesheet">
    <script src="https://esm.run/@material/web/all.js" type="module"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Sharp" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="{{ asset('css\registro-usuario-style.css') }}" rel="stylesheet">
    
<script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css">

@include('components.alert')


{{-- alerta que muestra cuando un producto se agrego con exito --}}


<!-- Resto del contenido de la página -->

<div class="contenedor-registro">


    <img src="{{ asset('img/cosatado-gato.png') }}" alt=""  id="imagen-cat">


    <form class="form" action="{{ route('validar-regitro') }}" method="POST" id="form">
        @csrf
        <p class="title"><i class="fa-solid fa-paw"></i> Registro</p>
        <p class="message">Regístrese ahora y obtenga acceso completo a nuestra aplicación.</p>
    
        <div class="inputContainer">
            <i class="fa-solid fa-user" style="width: 25px"></i>
            <input class="inputField" id="username" placeholder="Nombre de Usuario" type="text" name="name" required>
        </div>
    
        <div class="inputContainer">
            <i class="fa-solid fa-envelope" style="width: 25px"></i>
            <input class="inputField" id="email" placeholder="Email" type="email" name="email" required>
        </div>
    
        <div class="inputContainer">
            <i class="fa-solid fa-phone" style="width: 25px"></i>
            <p style="padding-top: 20px">+569</p>
            <input class="inputField" id="movile" placeholder="Celular" type="tel" name="movile" required>
        </div>
    
        <div class="inputContainer">
            <i class="fa-solid fa-lock" style="width: 25px"></i>
            <input class="inputField" id="password" placeholder="Contraseña" type="password" name="password" required>
        </div>
    
        <div class="inputContainer">
            <i class="fa-solid fa-lock" style="width: 25px"></i>
            <input class="inputField" id="confirmPassword" placeholder="Confirmar Contraseña" type="password" name="confirm_password" required>
        </div>
    
        <button class="submit" id="submit">Regístrarse</button>
        <hr>
        <p class="signin">¿Ya tienes una cuenta?<a href="{{ route('login') }}">Iniciar sesión</a></p>
    </form>
    
    <!-- Contenedor de alerta -->
    <div id="customAlerts" class="alert alert-dismissible fixed-bottom fade" >
        <span id="alertMessages"></span>
        <button type="button" class="close no-style" aria-label="Close" id="closeAlertsButton">
            <p id="aceptar">Aceptar</p>
        </button>
    </div>
    
    <script>
        // Función para mostrar la alerta
        function showAlert(message) {
            const alertBox = document.getElementById('customAlerts');
            const alertMessage = document.getElementById('alertMessages');
    
            // Insertar el mensaje y mostrar la alerta
            alertMessage.textContent = message;
            alertBox.style.display = 'block';
            alertBox.classList.add('show');
        }
    
        // Función para cerrar la alerta
        function closeAlert() {
            const alertBox = document.getElementById('customAlerts');
    
            // Ocultar la alerta y remover la clase 'show'
            alertBox.style.display = 'none';
            alertBox.classList.remove('show');
        }
    
        // Evento para cerrar la alerta al hacer clic en "Aceptar"
        document.getElementById('closeAlertsButton').addEventListener('click', closeAlert);
    
        // Validación del formulario
        document.getElementById('form').addEventListener('submit', function (e) {
            const mobileField = document.getElementById('movile');
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirmPassword');
    
            const mobileValue = mobileField.value;
            const passwordValue = passwordField.value;
            const confirmPasswordValue = confirmPasswordField.value;
    
            // Validaciones
            if (!/^\d{8}$/.test(mobileValue)) {
                e.preventDefault(); // Evitar el envío del formulario
                showAlert('El número de celular debe tener exactamente 8 dígitos.');
                return;
            }
    
            if (passwordValue.length < 5) {
                e.preventDefault(); // Evitar el envío del formulario
                showAlert('La contraseña debe tener al menos 5 caracteres.');
                return;
            }
    
            if (passwordValue !== confirmPasswordValue) {
                e.preventDefault(); // Evitar el envío del formulario
                showAlert('Las contraseñas no coinciden.');
                return;
            }
        });
    </script>
</div>


{{-- <div id="modal"> --}}

{{-- <div id="logo">


    <img src="img\logo-vet.png" alt="logo" width="100px">
    <h5>Regístrate</h5>

    <div id="volver-titulo" >
        <md-icon-button id="openDialogButton" href="javascript:history.back()">
            <md-icon>arrow_back</md-icon>
        </md-icon-button>
    </div>

</div>



<form action="{{ route('validar-regitro') }}" method="POST" id="form">
    @csrf

    <div class="contenedor-input">
        <md-filled-text-field label="Nombre Usuario" type="text" name="name" supporting-text="Ejemplo: Juanito Perez" required>
            <md-icon slot="trailing-icon">account_circle</md-icon>
        </md-filled-text-field>
    </div>

    <div class="contenedor-input">
        <md-filled-text-field label="Email" type="email" name="email" supporting-text="Ejemplo: correo@mail.com" required>
            <md-icon slot="trailing-icon">email</md-icon>
        </md-filled-text-field>
    </div>

    <div class="contenedor-input">
        <md-filled-text-field label="Celular"     prefix-text="+569 " type="tel" name="movile" supporting-text="Ejemplo: +56912121212" required>
            <md-icon slot="trailing-icon">phone</md-icon>
        </md-filled-text-field>
    </div>

    <div class="contenedor-input">
        <md-filled-text-field label="Contrase&ntilde;a" type="password" name="password" id="password" supporting-text="Mínimo 4 caracteres" required>
            <md-icon-button id="togglePassword" toggle slot="trailing-icon" aria-label="Mostrar/Ocultar Contraseña">
                <md-icon id="toggleIcon">visibility</md-icon>
                <md-icon slot="selected">visibility_off</md-icon>
            </md-icon-button>
        </md-filled-text-field>
    </div>

    <div class="contenedor-input">
        <md-filled-text-field label="Confirmar Contrase&ntilde;a" type="password" name="confirm_password" id="confirmPassword" required>
            <md-icon-button id="toggleConfirmPassword" toggle slot="trailing-icon" aria-label="Mostrar/Ocultar Contraseña">
                <md-icon id="toggleConfirmIcon">visibility</md-icon>
                <md-icon slot="selected">visibility_off</md-icon>
            </md-icon-button>
        </md-filled-text-field>
    </div>

    <!-- Contenedor para el mensaje de error de contraseñas no coincidentes -->
    <div id="passwordError" class="error-message" style="color: rgb(180, 6, 6); display: none;"><p>Las contraseñas no coinciden.</hp></div>

    <a class="buscar-botons" href="#" onclick="event.preventDefault(); validateAndSubmit();">
        <md-fab label="Reg&iacute;strarse">
            <md-icon slot="icon">how_to_reg</md-icon>
        </md-fab>
    </a>
</form>

</div> --}}



</x-home>