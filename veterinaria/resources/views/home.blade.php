<x-app-layout>
    <link href="{{ asset('css/home/home-style.css') }}" rel="stylesheet">

    <div>
        <h1>Bienvenido a la página de inicio</h1>
        {{-- Alerta que muestra productos bajo stock --}}
        @if ($productosBajoStock->count() > 0)
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Atención!</strong> Tienes {{ $productosBajoStock->count() }} productos con bajo stock.
                <button type="button" class="btn btn-primary" data-bs-toggle="collapse"
                    data-bs-target="#productosBajoStock">
                    Ver productos
                </button>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            <div id="productosBajoStock" class="collapse">
                <ul class="list-group mt-3">
                    @foreach ($productosBajoStock as $producto)
                        <li class="list-group-item">
                            {{ $producto->nombre }} - Stock: {{ $producto->stock_unidades }} (Mínimo requerido:
                            {{ $producto->cantidad_minima_requerida }})
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>





    <div class="parent">
            <div id="contenedor" class="div1">
                <h2>Resumen del día</h2>
                

            </div>

            <div id="contenedor" class="div2">
                Clientes atendidos hoy: 15
            </div>
            <div id="contenedor" class="div3">
                Citas programadas: 8
            </div>
            <div id="contenedor" class="div4">
                Nuevos registros: 3
            </div>
            <div id="contenedor" class="div5">
                Productos vendidos: 20
            </div>
        </div>

</x-app-layout>
