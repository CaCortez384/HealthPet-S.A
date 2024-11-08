<section>
    <div>


        <style>
           #icon-user {
    transform: scale(2); /* Aumenta el tamaño en un factor de 2, puedes ajustar el número */
    margin-right: 10px
           }

           #formulario-user{
            display: flex; 
            align-items: center; 
            justify-content: space-around;

           }


         #btn1{
            background-color: rgb(45, 141, 244);
         }
        #btn1:hover{
            background-color: rgb(0, 119, 255);
            transition: 0.1s;
        }

        
        @media (max-width: 1000px) {
    #formulario-user {
        flex-direction: column; /* Cambia la dirección de los elementos a columna */
        justify-content: center; /* Centra los elementos verticalmente */
        align-items: center; /* Centra los elementos horizontalmente */
    }

    .user-contenido{
        margin: 10px
    }
}

        </style>

<div>

        <h2 class="text-lg font-medium text-gray-900">
            <md-icon id="icon-user" >badge</md-icon>   {{ __('Informacion del Usuario') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Actualice la información del perfil y la dirección de correo electrónico de su cuenta.") }}
        </p>
    </div>

    

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form  id="formulario-user" method="post" action="{{ route('profile.update') }}" >
        @csrf
        @method('patch')

        <div class="user-contenido">

            <md-filled-text-field label="Nombre de Usuario" id="name" name="name" type="text" value="{{old('name', $user->name)}}" required autofocus autocomplete="name" >
            </md-filled-text-field>

            <x-alert class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="user-contenido">

            <md-filled-text-field label="Correo de Usuario" id="email" name="email" type="email" value="{{old('email', $user->email)}}" required autocomplete="username" >
            </md-filled-text-field>

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Haga clic aquí para volver a enviar el correo electrónico de verificación.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="user-contenido">

            <button type="submit" id="btn1" class="btn btn-lg" >Actulizar datos de usuario</button>

        </div>
    </form>

</div>
</section>
