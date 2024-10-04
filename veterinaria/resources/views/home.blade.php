<x-app-layout>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@material/web@latest/md-filled-select/md-filled-select.min.css">
    <link href="{{ asset('css/lista-productos-style.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-M0xuBCs8yz0+kUnD6s7aoVFEFAeF4IiJ60+EK4/N9Jeu8Hr0sJ0uoP6RW47HJ2Gs" crossorigin="anonymous">

    <div>
        {{-- Alerta que muestra productos bajo stock --}}
        @if ($productosBajoStock->count() > 0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Atención!</strong> Tienes {{ $productosBajoStock->count() }} productos con bajo stock.
                <button type="button" class="btn btn-primary" data-toggle="collapse" data-target="#productosBajoStock">
                    Ver productos
                </button>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div id="productosBajoStock" class="collapse">
                <ul class="list-group mt-3">
                    @foreach ($productosBajoStock as $producto)
                        <li class="list-group-item">
                            {{ $producto->nombre }} - Stock: {{ $producto->stock }} (Mínimo requerido: {{ $producto->cantidad_minima_requerida }})
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h1>Bienvenido a la página de inicio</h1>
        <!-- Aquí puedes agregar más contenido para tu página de inicio -->
    </div>
</x-app-layout>
