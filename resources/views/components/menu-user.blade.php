
<style>
  #contenedor-completo{
    display: flex; width: 100%; margin: auto;
  }
  #contenedos-list{
    height: 100%; margin-right: 30px;
  }
  #nav-expand{
    height:100%; border-radius: 20px; margin: auto; margin-top: 50px; box-shadow: 5px 5px 20px black;
  }
  #lista-md{
    max-width: 300px; border-radius: 20px; display: flex; justify-content: center;
  }


</style>

<div id="contenedor-completo">
<div id="contenedos-list" >

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
    md-list{
      display: flex;
      justify-content: center;
      align-items: center; 
      margin: 10px;
      flex-direction: row;
      width: 100%;
      margin: auto;
    }
    #contenedor-completo{
      flex-direction: column;
      margin: auto;
    }
    #contenedos-list{
      margin: auto
    }
}
  </style>

<nav id="nav-expand" class="navbar navbar-expand-lg   " >
    <div class="container-fluid">


        <nav class="nav flex-column"  >


            <md-list id="lista-md" >


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

                <a  href="{{ route('buscar.pedido') }}" style="text-decoration: none">
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




