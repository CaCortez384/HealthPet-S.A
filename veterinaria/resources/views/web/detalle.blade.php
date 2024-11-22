<x-home>
    <link href="{{ asset('css/home/detalle-producto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/boton-sucess-style.css') }}" rel="stylesheet">

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
    {{-- <div id="contenedor-detalle">
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
 --}}

    <div class="breadcrumb">
        <a href="{{ route('petshop') }}">Petshop </a> <strong> <span> / </span></strong>
        <a href="#">{{ $producto->nombre }}</a>
    </div>


    <div class="product-container">

        <div class="product-image ">
            <img src="{{ asset('storage/' . $producto->imagen) }}" class="imagen" 
            alt="{{ $producto->nombre }}">
        </div>

        <div class="product-info">
            <div class="product-details">
                <h1><strong><span>{{ $producto->nombre }}</span></strong></h1>
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
                                <br>
                <h5 class="card-text" id="precio">Precio: <span
                    class="price">${{ $producto->precio_de_venta }}</span></h5>

                    <p class="card-text"><small class="text-muted">Stock: {{ $producto->stock_unidades }}</small>
                    </p>



                @if ($producto->stock_unidades == 0)    
                    <button class="CartBtn add-to-cart-button" data-product-id="{{ $producto->id }}"  data-product-name="{{ $producto->nombre }}" 
                        onclick="event.stopPropagation();">
                            <span class="IconContainer"> 
                              <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="rgb(17, 17, 17)" class="cart"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path></svg>
                            </span>
                            <p class="text">Realizar pedido</p>
                          </button>

            @else
                    <button class="CartBtn add-to-cart-button" data-product-id="{{ $producto->id }}"  data-product-name="{{ $producto->nombre }}" 
                        onclick="event.stopPropagation();">
                            <span class="IconContainer"> 
                              <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512" fill="rgb(17, 17, 17)" class="cart"><path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path></svg>
                            </span>
                            <p class="text">Agregar al carrito</p>
                          </button>

            @endif




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
    </div>

        <!-- Contenedor de alerta -->
        <div id="customAlert" class="alert alert-dismissible fixed-bottom fade" style="display: flex; align-items: center; justify-content: space-between">
            <span id="alertMessage"></span>
            <button type="button" class="close no-style" aria-label="Close" id="closeAlertButton">
                <p id="aceptar">Aceptar</p>
            </button>
        </div>
        


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
                setTimeout(closeAlert, 3500);
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
