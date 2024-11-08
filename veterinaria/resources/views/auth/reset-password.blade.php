<x-home>

    <style>
        #contenedor-pass{
            display: flex; 
            justify-content: space-around; 
            align-items: center;

        }

        #btn1{
            background-color: rgb(45, 141, 244);
         }
        #btn1:hover{
            background-color: rgb(0, 119, 255);
            transition: 0.1s;
        }

        #boton-pass{
            display: flex;
            justify-content: center;
            margin-top: 20px;
       
        }
        

        @media (max-width: 900px) {
    #contenedor-pass {
        flex-direction: column; /* Cambia la dirección de los elementos a columna */
        justify-content: center; /* Centra los elementos verticalmente */
        align-items: center; /* Centra los elementos horizontalmente */
    }
}
    </style>
    <div style="width: 80%; margin: auto;  border-radius: 20px; padding: 20px; margin-top: 20px; margin-bottom: 20px; background-color: rgba(234, 235, 237, 0.975);box-shadow: 10px 5px 30px black;">
    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <h1>Restablecer contraseña</h1>
        <p>Por favor, complete los siguientes campos para restablecer su contraseña.</p>

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        
        <!-- Email Address -->
        <div id="contenedor-pass" > 



            <md-filled-text-field
            type="email"
            label="Confirmar Email"
            required
            supporting-text="*requerido"
            error-text="Please fill out this field"
            name="email"
            id="email">
        </md-filled-text-field>

            <x-alert :messages="$errors->get('email')" class="mt-2" />
    

        <!-- Password -->


            <md-filled-text-field label="Nueva Contraseña" type="password" id="password" name="password" required  supporting-text="*requerido"
            error-text="Please fill out this field">

            </md-filled-text-field>
            <x-alert :messages="$errors->get('password')" class="mt-2" />
 

        <!-- Confirm Password -->
  




                <md-filled-text-field label="Confirmar Nueva Contraseña" type="password" id="password_confirmation" name="password_confirmation" required  supporting-text="*requerido"
                error-text="Please fill out this field">
    
                </md-filled-text-field>
                <x-alert :messages="$errors->get('password')" class="mt-2" />

                  
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div id="boton-pass">

            <button type="submit" id="btn1" class="btn btn-lg" >Restablecer</button>

        </div>

    </form>
</div>
</x-home>
