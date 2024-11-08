<x-home>
    <div id="modal-recuerar" style="width: 80%; margin: auto;  border-radius: 20px; padding: 20px; margin-top: 20px; margin-bottom: 20px; display: flex; justify-content: center; align-items: center; flex-direction: column; background-color: rgba(234, 235, 237, 0.975);box-shadow: 10px 5px 30px black;">
    <h1>Recuperar Contraseña</h1>

 
    <div class="mb-4 text-sm text-gray-600">
        {{ __('¿Olvidaste tu contraseña? Ningún problema. Simplemente háganos saber su dirección de correo electrónico y le enviaremos un enlace para restablecer su contraseña que le permitirá elegir una nueva.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />


    <style>
         #btn1{
            background-color: rgb(45, 141, 244);
         }
        #btn1:hover{
            background-color: rgb(0, 119, 255);
            transition: 0.1s;
        }
    </style>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Email @</span>
                <input type="email" name="email" class="form-control" placeholder="ejemplo@mail.com" aria-label="Email para restablecer contraseña" required autofocus  >
              </div>

            <x-alert :messages="$errors->get('email')" class="mt-2" />
                
        </div>

        <div class="flex items-center justify-end mt-4">

            <button type="submit" id="btn1" class="btn btn-lg" >Recuperar Contraseña</button>

        </div>


    </div>
    </form>
</x-home>
