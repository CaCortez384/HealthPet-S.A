<x-home>
    <link href="{{ asset('css/home/detalle-producto.css') }}" rel="stylesheet">

    <style>
        body {
            position: relative;
            background-image: url('{{ asset('img/clientes/fondo-cliente.png') }}');

        }

        .col-md-4 img:hover {
            cursor: url('{{ asset('img/cursor-gato-hover.png') }}'), auto;
        }
    </style>
    <!-- Contenido de la página -->
    <div id="contenedor-detalle">
        <h1 class="titulo-veterinaria">Detalle del Producto <i class="fa-solid fa-paw"></i></h1>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4" style="margin: auto">
                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="img-fluid "
                        alt="{{ $producto->nombre }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h4 class="card-title"> <strong><span>{{ $producto->nombre }}</span></strong></h4>
                        <p class="card-text"><strong>Marca:</strong>
                            {{ $producto->detalleWeb->marca ?? 'Marca no disponible' }}</p>
                        <p class="card-text"><strong>Descripcion:</strong>
                            {{ $producto->detalleWeb->descripcion ?? 'Sin Descripcion' }}</p>
                        <p class="card-text"><strong>Categoría:</strong>
                            {{ $producto->categoria->nombre ?? 'No disponible' }}
                            {{ $producto->presentacion->nombre ?? '' }}</p>
                        <p class="card-text"><strong>Contenido neto:</strong>
                            {{ number_format($producto->detalleWeb->contenido_neto, 0, '.', '') ?? '' }}
                            {{ $producto->unidad->nombre ?? '' }}</p>
                        <h5 class="card-text" id="precio">Precio: <span
                                class="price">${{ $producto->precio_de_venta }}</span></h5>

                        <p class="card-text"><small class="text-muted">Stock: {{ $producto->stock_unidades }}</small>
                        </p>
                        <p class="card-text"><i class="fa-solid fa-location-dot"></i><small class="text-muted">
                                Sucursal: Melipilla</small></p>


                        <button class="add-to-cart add-to-cart-button" data-product-id="{{ $producto->id }}">Agregar al
                            carrito</button>
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


    {{-- <div class="breadcrumb">
        <a href="#">Petshop</a> / 
        <a href="#">Alimento</a> / 
        <a href="#">Alimento Perro</a>
    </div>


    <div class="product-container">
        <div class="product-image ">
            <img src="{{ asset('storage/' . $producto->imagen) }}" class="" style="width: 48%"
            alt="{{ $producto->nombre }}">
        </div>
        <div class="product-info">
            <div class="product-details">
                <h1>Nombre del Producto</h1>
                <p><strong>Marca:</strong> Marca del Producto</p>
                <p><strong>Descripción:</strong> Una breve descripción del producto.</p>
                <p><strong>Categoría:</strong> Categoría del Producto</p>
                <p><strong>Contenido Neto:</strong> 500g</p>
                <p><strong>Precio:</strong> $12,000</p>
                <p><strong>Stock:</strong> Disponible</p>
                <button class="add-to-cart">Agregar al Carrito</button>
            </div>
            <div class="seccion-seguro">
                <hr>
                <h5><i class="fa-solid fa-lock"></i> Pago seguro con WebPay Plus</h5>
                <hr>
                <h5><i class="fa-solid fa-arrows-spin"></i> Garantía y Políticas de Devolución</h5>
                <hr>
                <h5><i class="fa-solid fa-store"></i> Solo disponibilidad en tienda física</h5>
                <hr>
            </div>
        </div>
    </div> --}}


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
