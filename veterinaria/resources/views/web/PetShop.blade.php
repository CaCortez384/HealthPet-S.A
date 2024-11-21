<x-home>
    <link href="{{ asset('css/home/PetShop.css') }}" rel="stylesheet">
    <!-- Asegúrate de cargar jQuery primero -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/Web/scriptPetShop.js') }}" defer></script>


    <!-- Contenido de la página -->


    <div class="wrap">
        @include('components.alert')
        @section('content')
            @include('components.alert')
        @endsection

        <Div>
            <h1>¡Compra y Reserva productos para tu mascota! Paga un 50% al hacer el pedido o el total y recógelo en
                nuestra veterinaria.
            </h1>
        </Div>

        <div class="store-wrapper">
            <!-- Listado de categorías -->
            <div class="category_list">
                <a href="#" class="category_item" category="all">Todo</a>
                <a href="#" class="category_item" category="gato">Gato</a>
                <a href="#" class="category_item" category="perro">Perro</a>
                <a href="#" class="category_item" category="snack-gato">snacks Gato</a>
                <a href="#" class="category_item" category="snack-perro">Snacks Perro</a>
                <a href="#" class="category_item" category="humeda-gato">Comida humeda Gato</a>
                <a href="#" class="category_item" category="humeda-perro">Comida humeda Perro</a>
                <div class="price-filter">
                    <h4>Filtrar por precio</h4>
                    <input type="range" id="price-range" min="0" max="50000" value="50000" step="1000">
                    <p>Precio máximo: $<span id="price-display">50000</span></p>
                    <button id="apply-price-filter">Aplicar filtro</button>
                </div>

            </div>
            <!-- Listado de productos -->
            <section class="products-list">
                @foreach ($productos as $producto)
                    <div class="product-item" category="{{ $producto->id_categoria }}"
                        onclick="goToDetail({{ $producto->id }})">
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                        <div class="product-details">
                            <h6>{{ $producto->nombre }}</h6>
                            <p>Precio: <span class="price">${{ $producto->precio_de_venta }}</span>
                            </p>
                            <p>Stock: {{ $producto->stock_unidades }}</p>
                            @if ($producto->stock_unidades == 0)
                                <button class="add-to-cart add-to-cart-button" data-product-id="{{ $producto->id }}"
                                    onclick="event.stopPropagation();">Realizar pedido</button>
                                <span id="adding-cart-{{ $producto->id }}"
                                    class="btn btn-warning btn-block text-center added-msg"
                                    style="display:none;">Añadido!</span>
                            @else
                                <button class="add-to-cart add-to-cart-button" data-product-id="{{ $producto->id }}"
                                    onclick="event.stopPropagation();">Agregar al carrito</button>
                                <span id="adding-cart-{{ $producto->id }}"
                                    class="btn btn-warning btn-block text-center added-msg"
                                    style="display:none;">Añadido!</span>
                            @endif
                        </div>
                    </div>
                @endforeach
                <script>
                    function goToDetail(productId) {
                        window.location.href = '{{ url('detalle') }}/' + productId;
                    }
                </script>
            </section>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            function updateCartContent() {
                $.ajax({
                    type: 'GET',
                    url: '/get-cart-content',
                    success: function(cartData) {
                        $('.carrito-slide .lista-productos').html(cartData.html);
                        $('.subtotal span:last-child').text('$' + number_format(cartData.subtotal, 0,
                            ',', '.'));
                        $('.total span:last-child').text('$' + number_format(cartData.total, 0, ',',
                            '.'));
                        $('.descuento span:last-child').text('$' + number_format(cartData.descuento, 0,
                            ',', '.'));
                        bindCartButtons();
                        $('.carrito-slide').addClass('visible');
                    },
                    error: function(error) {
                        console.error('Error updating cart content:', error);
                    }
                });
            }

            function number_format(number, decimals, dec_point, thousands_sep) {
                number = (number + '').replace(',', '').replace(' ', '');
                var n = !isFinite(+number) ? 0 : +number,
                    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                    sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
                    dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
                    s = '',
                    toFixedFix = function(n, prec) {
                        var k = Math.pow(10, prec);
                        return '' + Math.round(n * k) / k;
                    };
                s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
                if (s[0].length > 3) {
                    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
                }
                if ((s[1] || '').length < prec) {
                    s[1] = s[1] || '';
                    s[1] += new Array(prec - s[1].length + 1).join('0');
                }
                return s.join(dec);
            }

            function bindCartButtons() {
                // Función para incrementar la cantidad
                $('.sumar').off('click').on('click', function() {
                    var productId = $(this).data('id');
                    $.ajax({
                        type: 'POST',
                        url: '/update-cart',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: productId,
                            action: 'increase'
                        },
                        success: function(data) {
                            updateCartContent();
                        },
                        error: function(error) {
                            console.error('Error updating cart:', error);
                        }
                    });
                });

                // Función para decrementar la cantidad
                $('.restar').off('click').on('click', function() {
                    var productId = $(this).data('id');
                    $.ajax({
                        type: 'POST',
                        url: '/update-cart',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: productId,
                            action: 'decrease'
                        },
                        success: function(data) {
                            updateCartContent();
                        },
                        error: function(error) {
                            console.error('Error updating cart:', error);
                        }
                    });
                });

                // Función para eliminar el producto
                $('.eliminar').on('click', function() {
                    var productId = $(this).data('id');

                    $.ajax({
                        type: 'POST',
                        url: '/update-cart',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: productId,
                            action: 'remove'
                        },
                        success: function(data) {
                            updateCartContent();
                        },
                        error: function(error) {
                            console.error('Error removing product from cart:', error);
                        }
                    });
                });
            }
            // Añadir al carrito
            $('.add-to-cart-button').off('click').on('click', function() {
                var productId = $(this).data('product-id');
                $.ajax({
                    type: 'GET',
                    url: '/add-to-cart/' + productId,
                    success: function(data) {
                        $("#adding-cart-" + productId).show();
                        $("#add-cart-btn-" + productId).hide();
                        updateCartContent();
                    },
                    error: function(error) {
                        console.error('Error adding to cart:', error);
                    }
                });
            });

            // Inicializar los botones del carrito
            bindCartButtons();
        });
    </script>
</x-home>
