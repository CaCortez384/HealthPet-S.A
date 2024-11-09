<x-home>
    <link href="{{ asset('css/home/PetShop.css') }}" rel="stylesheet">
    <!-- Contenido de la página -->
    <div class="wrap">
        <h1>Detalle del Producto</h1>
        <div class="product-detail">
            <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
            <div class="product-details">
                <h4>Marca: {{ $producto->nombre }}</h4>
                <p>Precio: <span class="price">${{ $producto->precio_de_venta }}</span></p>
                <p>Stock: {{ $producto->stock_unidades }}</p>
                <p>Categoría: {{ $producto->categoria->nombre ?? 'No disponible' }}</p>
                <p>Descripción: {{ $producto->descripcion }}</p> <!-- Si tienes descripción del producto -->
                <button class="add-to-cart add-to-cart-button" data-product-id="{{ $producto->id }}">Agregar al carrito</button>
            </div>
        </div>
    </div>
</x-home>
