<x-app-layout>


    {{-- base para trabajar, se podria guarar el css para las campos donde se ingrsaran los datos como enb estre ejemplo --}}
    
      <div style="background: white; margin-top: 10px; border-radius: 20px; padding: 20px;">
        <div>
          <h1>Inicio</h1>
          <p>holas registro</p>
        
        </div>
      </div>
    
    
      <div style="background: white; margin-top: 10px; border-radius: 20px; padding: 20px;">
        <div>
            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
    
            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif
    
            <form action="{{ route('validar-regitro') }}" method="POST">
                @csrf
    
                <div>
                    <md-filled-text-field label="Email" type="email" name="email" required></md-filled-text-field>
                    <md-filled-text-field label="Contraseña" type="password" name="password" required></md-filled-text-field>
                    <md-filled-text-field label="Nombre" name="name" required></md-filled-text-field>
    
                    <button type="submit">Regístrate</button>
                </div>
            </form>
        </div>
    </div>
    
    
    </x-app-layout>