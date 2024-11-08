
<div style="display: flex; width: 100%; margin: auto">
<div style=" height: 100%; margin-right: 30px;">

  <style>
    /* Mostrar 'Perfil' por defecto */
.perfil-text {
    display: inline;
}

/* Cuando la pantalla es más pequeña que 600px, ocultar la palabra 'Perfil' */
@media (max-width: 600px) {
    .perfil-text {
        display: none;
    }
}
  </style>

<nav class="navbar navbar-expand-lg   " style="height:100%; border-radius: 20px; margin: auto; margin-top: 50px; box-shadow: 5px 5px 20px black;" >
    <div class="container-fluid">


        <nav class="nav flex-column"  >


            <md-list style="max-width: 300px; border-radius: 20px">


              <a href="{{route('profile.edit')}}"  style="text-decoration: none">
                <md-list-item>
                    <md-icon>person</md-icon>
                    <span class="perfil-text">Perfil</span>
                </md-list-item>
            </a>


                <md-divider></md-divider>

                <a href="{{route('profile.pedidos')}}"  style="text-decoration: none">
                <md-list-item>
                    <md-icon >local_mall</md-icon>

                  <span class="perfil-text">Mis Pedidos</span>
                 
                </md-list-item>
            </a>

                <md-divider></md-divider>

                <a href="" style="text-decoration: none">
                <md-list-item>
                    <md-icon >two_pager_store</md-icon>
                  <span class="perfil-text">Consultar Pedidos</span>
                </md-list-item>
            </a>

            <md-divider></md-divider>

            
            <a href="{{ route('logout') }}"  style="text-decoration: none">
                <md-list-item>
                    <md-icon>power_settings_new</md-icon>      
                  <span class="perfil-text">Cerrar Sesion</span>
                </md-list-item>
            </a>
              </md-list>
      
          </nav>

    </div>
  </nav>
</div>

        <div id="contenido-user" style="padding: 15px;height:100%; border-radius: 20px; margin: auto; margin-top: 50px;margin-bottom: 50px;; box-shadow: 5px 5px 20px rgb(16, 24, 29); width: 80% ;" >
            {{ $slot }}
        </div>  

    </div>




