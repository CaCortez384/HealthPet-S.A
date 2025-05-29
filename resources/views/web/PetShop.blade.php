<x-home>

    <!-- Asegúrate de cargar jQuery primero -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/Web/scriptPetShop.js') }}" defer></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        var csrfToken = $('meta[name="csrf-token"]').attr('content'); // Obtener el token CSRF desde una meta tag
    </script>
        <link href="{{ asset('css/home/PetShop.css') }}" rel="stylesheet">|

    <!-- Contenido de la página -->

<div id="fondo"></div>
    <div class="wrap">
        @include('components.alert')
        @section('content')
            @include('components.alert')
        @endsection

        <div id="contenedor-titulo-filtos" >
            <h4>¡Compra y reserva productos para tu mascota! Si el producto está disponible en stock, paga el total y retíralo de inmediato en nuestra veterinaria. Si es un pedido, abona el 50% al hacer la compra y paga el resto cuando el producto esté listo para retirar
            </h4>


            <div class="category_list">
                <a href="javascript:void(0);" class="category_item" category="all">Todo</a>
                <a href="javascript:void(0);" class="category_item" category="gato">Gato</a>
                <a href="javascript:void(0);" class="category_item" category="perro">Perro</a>
                <a href="javascript:void(0);" class="category_item" category="snack-gato">snacks Gato</a>
                <a href="javascript:void(0);" class="category_item" category="snack-perro">Snacks Perro</a>
                <a href="javascript:void(0);" class="category_item" category="humedo-gato">Comida humeda Gato</a>
                <a href="javascript:void(0);" class="category_item" category="humedo-perro">Comida humeda Perro</a>
                {{-- para agregar otro filtro se debe utilizar en el href javascript:void(0); para evitar que no se agreguen los productos al carro. --}}


            </div>
            <div class="price-filter">
                <h4>Filtrar por precio</h4>
                <input type="range" id="price-range" min="0" max="50000" value="50000" step="1000">
                <p>Precio máximo: $<span id="price-display">50000</span></p>
                <button id="apply-price-filter">Aplicar filtro</button>
            </div>
        </div>

        <div class="store-wrapper">
            <!-- Listado de categorías -->

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
                                <button class="add-to-cart add-to-cart-button" data-product-id="{{ $producto->id }}" data-product-name="{{ $producto->nombre }}" 
                                    onclick="event.stopPropagation();">Realizar pedido</button>

                            @else
                                <button class="add-to-cart add-to-cart-button" data-product-id="{{ $producto->id }}" data-product-name="{{ $producto->nombre }}" 
                                    onclick="event.stopPropagation();">Agregar al carrito</button>

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

                    <!-- Contenedor de alerta -->
        <div id="customAlert" class="alert alert-dismissible fixed-bottom fade" style="display: flex; align-items: center; justify-content: space-between">
            <span id="alertMessage"></span>
            <button type="button" class="close no-style" aria-label="Close" id="closeAlertButton">
                <p id="aceptar">Aceptar</p>
            </button>
        </div>
        
        
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

<script>
    // Función para mostrar la alerta
    function showAlert(message) {
        const alertBox = document.getElementById('customAlert');
        const alertMessage = document.getElementById('alertMessage');

        // Insertar el mensaje y mostrar la alerta
        alertMessage.textContent = message;
        alertBox.style.display = 'flex';
        alertBox.classList.add('show');

        // Ocultar automáticamente después de 3 segundos
        setTimeout(closeAlert, 3000);
    }

    // Función para cerrar la alerta
    function closeAlert() {
        const alertBox = document.getElementById('customAlert');

        // Ocultar la alerta y remover la clase 'show'
        alertBox.style.display = 'none';
        alertBox.classList.remove('show');
    }

    // Agregar eventos a los botones de "Agregar al carrito"
    document.addEventListener('DOMContentLoaded', function () {
        const cartButtons = document.querySelectorAll('.add-to-cart-button');
        cartButtons.forEach(button => {
            button.addEventListener('click', function () {
                const productName = this.dataset.productName; // Obtiene el nombre del producto
                showAlert(`"${productName}" ha sido agregado al carrito.`);
            });
        });
    });
</script>
</x-home>
