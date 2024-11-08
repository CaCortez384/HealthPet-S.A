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

        <h2 class="text-lg font-medium text-gray-900">

             <md-icon id="icon-user" >lock</md-icon>  
            {{ __('Actulizar Contraseña') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Asegúrese de que su cuenta utilice una contraseña larga y aleatoria para mantenerse segura') }}
        </p>
    </div>

    <form id="formulario-user" method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')




        <div class="user-contenido">

            <md-filled-text-field label="Contraseña Actual" id="update_password_current_password" name="current_password" type="password"  required autofocus autocomplete="current-password" >
            </md-filled-text-field>

            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
         

        </div>



        <div class="user-contenido">

            <md-filled-text-field label="Nueva Contraseña" id="update_password_password" name="password" type="password"  required autocomplete="new-password" >
            </md-filled-text-field>

            
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="user-contenido">

            <md-filled-text-field label="Confirme Contraseña" id="update_password_password_confirmation" name="password_confirmation" type="password"  required autocomplete="new-password" >
            </md-filled-text-field>

                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="user-contenido">

            <button type="submit" id="btn1" class="btn btn-lg" >Actulizar Contraseña</button>

        </div>
    </form>
</section>
