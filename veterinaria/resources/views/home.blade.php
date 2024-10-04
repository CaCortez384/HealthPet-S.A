<x-app-layout>

    <div>
        {{-- Alerta que muestra productos bajo stock --}}
        @if ($productosBajoStock->count() > 0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Atención!</strong> Tienes {{ $productosBajoStock->count() }} productos con bajo stock.
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#productosBajoStock">
                    Ver productos
                </button>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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
    </div>

        <h1>Bienvenido a la página de inicio</h1>
        <!-- Aquí puedes agregar más contenido para tu página de inicio -->
    </div>
</x-app-layout>
