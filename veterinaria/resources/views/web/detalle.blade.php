<x-home>
    <link href="{{ asset('css/home/detalle-producto.css') }}" rel="stylesheet">

    <style>
        body{
            position: relative;
            background-image: url('{{ asset("img/clientes/fondo-cliente.png") }}');

        }

        .col-md-4 img:hover{
    cursor: url('{{ asset("img/cursor-gato-hover.png") }}'), auto;
}

    </style>
    <!-- Contenido de la página -->
    <div id="contenedor-detalle">
        <h1 class="titulo-veterinaria">Detalle del Producto <i class="fa-solid fa-paw"></i></h1>
        <div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4" style="margin: auto">
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid rounded-start" alt="{{ $producto->nombre }}">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h4 class="card-title"> <strong><span>{{ $producto->nombre }}</span></strong></h4>
                  <p class="card-text"><strong>Marca:</strong> {{ $producto->detalleWeb->marca ?? 'Marca no disponible' }}</p>
                  <p class="card-text"><strong>Descripcion:</strong>  {{ $producto->detalleWeb->descripcion ?? 'Sin Descripcion' }}</p>
                  <p class="card-text"><strong>Categoría:</strong>  {{ $producto->categoria->nombre ?? 'No disponible' }} {{ $producto->presentacion->nombre ?? '' }}</p>
                  <p class="card-text"><strong>Contenido neto:</strong>  {{ number_format($producto->detalleWeb->contenido_neto, 0, '.', '') ?? '' }} {{ $producto->unidad->nombre ?? '' }}</p>
                  <h5 class="card-text" id="precio">Precio: <span class="price">${{ $producto->precio_de_venta }}</span></h5>

                  <p class="card-text"><small class="text-muted">Stock: {{ $producto->stock_unidades }}</small></p>
                  <p class="card-text"><i class="fa-solid fa-location-dot"></i><small class="text-muted"> Sucursal: Melipilla</small></p>


             <button class="add-to-cart add-to-cart-button" data-product-id="{{ $producto->id }}">Agregar al carrito</button>
                </div>
              </div>
            </div>


            <div class="seccion-seguro">
                <hr>
                <h5><i class="fa-solid fa-lock"></i>Pago seguro con WebPay Plus</h5>
                <hr>
                <h5><i class="fa-solid fa-arrows-spin"></i>Garantía y Políticas de Devolución</h5>
                <hr>
                <h5><i class="fa-solid fa-store"></i>Solo disponibilidad en tienda fisica</h5>
                <hr>


            </div>
          </div>
    </div>
</x-home>
