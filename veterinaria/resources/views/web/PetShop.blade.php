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
                <a href="#" class="category_item" category="ordenadores">Gato adulto</a>
                <a href="#" class="category_item" category="laptops">Gato Bebe</a>
                <a href="#" class="category_item" category="smartphones">Perro Adulto</a>
                <a href="#" class="category_item" category="monitores">Cachorro</a>
                <a href="#" class="category_item" category="audifonos">Snacks</a>
                <div class="price-filter">
                    <h4>Filtrar por precio</h4>
                    <input type="range" id="price-range" min="0" max="50000" value="50000" step="1000" oninput="updatePriceDisplay(this.value)">
                    <p>Precio máximo: $<span id="price-display">50000</span></p>
                    <button onclick="applyPriceFilter()">Aplicar filtro</button>
                </div>
            </div>
            <!-- Listado de productos -->
            <section class="products-list">
                <div class="product-item" category="alimento">
                    <img src="{{ asset('#') }}" alt="Alimento para Gato">
                    <div class="product-details">
                        <h4>Marca: Whiskas</h4>
                        <p>Producto: Alimento para Gato Adulto</p>
                        <p>Precio: <span class="price">$10.000</span></p>
                        <p class="offer">Oferta: 2x$15.000</p>
                        <button class="add-to-cart">Agregar al carrito</button>
                    </div>
                </div>
                <!-- Puedes añadir más productos aquí de la misma manera -->
            </section>
        </div>
    </div>

    
</x-home>
