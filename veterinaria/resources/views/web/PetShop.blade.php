<x-home>
    
    <link href="{{ asset('css/home/PetShop.css') }}" rel="stylesheet">

    <!-- Asegúrate de cargar jQuery primero -->
    <script src="{{ asset('js/jquery-pet.js') }}" defer></script>
    <script src="{{ asset('js/scriptPetShop.js') }}" defer></script>

    <!-- Contenido de la página -->
    <div class="wrap">
        <h1>Escoge un producto</h1>
        <div class="store-wrapper">
            <!-- Listado de categorías -->
            <div class="category_list">
                <a href="#" class="category_item" category="all">Todo</a>
                <a href="#" class="category_item" category="gato-adulto">Gato adulto</a>
                <a href="#" class="category_item" category="gato-bebe">Gato Bebé</a>
                <a href="#" class="category_item" category="perro-adulto">Perro Adulto</a>
                <a href="#" class="category_item" category="cachorro">Cachorro</a>
                <a href="#" class="category_item" category="snacks">Snacks</a>
                <div class="price-filter">
                    <h4>Filtrar por precio</h4>
                    <input type="range" id="price-range" min="0" max="50000" value="50000" step="1000" oninput="updatePriceDisplay(this.value)">
                    <p>Precio máximo: $<span id="price-display">50000</span></p>
                    <button onclick="applyPriceFilter()">Aplicar filtro</button>
                </div>
            </div>
            <!-- Listado de productos -->
            <section class="products-list">
                @foreach($productos as $producto)
                    <div class="product-item" category="{{ $producto->id_categoria }}">
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                        <div class="product-details">
                            <h4>Marca: {{ $producto->nombre }}</h4>
                            <p>Descripción: {{ $producto->descripcion }}</p>
                            <p>Precio: <span class="price">${{ number_format($producto->precio_de_venta, 0, ',', '.') }}</span></p>
                            <button class="add-to-cart">Agregar al carrito</button>
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
    
</x-home>
