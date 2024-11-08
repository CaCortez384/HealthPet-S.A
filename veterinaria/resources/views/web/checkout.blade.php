<x-home>

    <link href="{{ asset('css/home/checkout-style.css') }}" rel="stylesheet">
    <div class="checkout-container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <!-- Formulario de Pago -->
        <div class="payment-form">
            <h2>Detalles de Pago</h2>
            <form action="{{ route('processCheckout') }}" method="POST">
                @csrf
                @if (Auth::check())
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre1" value="{{ Auth::user()->name }}" readonly disabled
                            required>
                        <input type="hidden" name="nombre" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" id="correo1" value="{{ Auth::user()->email }}" readonly disabled
                            required>
                        <input type="hidden" name="correo" value="{{ Auth::user()->email }}">
                    </div>
                @else
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input type="email" id="correo" name="correo" required>
                    </div>
                @endif
                <div class="form-group">
                    <label for="telefono">Teléfono</label>
                    <input type="text" id="telefono" name="telefono" pattern="\+569[0-9]{8}"
                        placeholder="+569XXXXXXXX" value="+569" required
                        oninput="if(!this.value.startsWith('+569')) this.value='+569' + this.value.slice(4)">
                </div>
                <div class="form-group">
                    <label for="metodo_pago">Método de Pago</label>
                    <select id="metodo_pago" name="metodo_pago" required>
                        <option value="3">Tarjeta de Débito</option>
                        <option value="2">Tarjeta de Crédito</option>
                        <option value="4">Transferencia Bancaria</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="nota">Nota del pedido</label>
                    <input type="text" id="nota" name="nota" required>
                </div>

                <!-- Campos ocultos para las cosas en el carrito -->
                @foreach ($cart as $id => $details)
                    <input type="hidden" name="productos[{{ $id }}][id_producto]"
                        value="{{ $id }}">
                    <input type="hidden" name="productos[{{ $id }}][cantidad]"
                        value="{{ $details['quantity'] }}">
                    <input type="hidden" name="productos[{{ $id }}][descuento]"
                        value="{{ isset($descuentos[$id]) ? $descuentos[$id] : 0 }}">
                    <input type="hidden" name="productos[{{ $id }}][precio]"
                        value="{{ $details['precio'] }}">
                @endforeach
                <div class="campos-ocultos">
                    <!-- Campo oculto para el total -->

                    <input type="hidden" name="total_pedido" id="subtotal">
                    <input type="hidden" name="total" id="total_pedido">
                </div>


                <button type="submit" class="checkout-button">Realizar Pago</button>

            </form>
        </div>
        <!-- Información del Carrito -->
        <div class="cart-summary">
            <h2>Resumen del Carrito</h2>
            <ul class="lista-productos">
                @if (count($cart) > 0)
                    @foreach ($cart as $id => $details)
                        <?php $subtotal = $details['precio'] * $details['quantity']; ?>
                        <li class="producto">
                            <div class="card">
                                <div class="card-body">
                                    <img src="{{ asset('storage/' . $details['imagen']) }}"
                                        alt="{{ $details['nombre'] }}" class="imagen-producto">
                                    <div class="detalles-producto">
                                        <span class="nombre">{{ $details['nombre'] }}</span>
                                        <span class="precio">${{ $details['precio'] }}</span>
                                        <div class="cantidad">
                                            <button class="restar material-symbols-outlined"
                                                data-id="{{ $id }}">remove</button>
                                            <span>{{ $details['quantity'] }}</span>
                                            <button class="sumar material-symbols-outlined"
                                                data-id="{{ $id }}">add</button>
                                        </div>
                                    </div>
                                    <button class="eliminar material-symbols-outlined"
                                        data-id="{{ $id }}">delete</button>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @else
                    <li class="producto">
                        <div class="card">
                            <div class="card-body">
                                <span class="nombre">Tu carrito está vacío</span>
                            </div>
                        </div>
                    </li>
                @endif
            </ul>

            <div class="cart-totals">
                <div class="subtotal">
                    <span>Subtotal:</span>
                    <span>${{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="total">
                    <span>Total:</span>
                    <span>${{ number_format($total_pedido, 0, ',', '.') }}</span>
                </div>
            </div>
            @foreach ($cart as $id => $details)
                @if ($details['stock'] == 0)
                    <div class="stock-warning" id="stock-warning-{{ $id }}">
                        <p>El producto <strong>{{ $details['nombre'] }}</strong> no está en stock. Para pedidos se
                            abona el 50% del valor del producto.</p>
                        <div class="descuento" data-product-id="{{ $id }}">
                            <span>50% de <strong>{{ $details['nombre'] }}</strong>:</span>
                            <span>${{ number_format($descuentos[$id], 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endif
            @endforeach

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
                        // Actualizar contenido del slide del carrito
                        $('.carrito-slide .lista-productos').html(cartData.html);
                        $('.carrito-slide .subtotal span:last-child').text('$' + number_format(cartData
                            .subtotal, 0, ',', '.'));
                        $('.carrito-slide .total span:last-child').text('$' + number_format(cartData
                            .total_pedido, 0, ',', '.'));

                        // Actualizar contenido del resumen del carrito
                        $('.cart-summary .lista-productos').html(cartData.html);
                        $('.subtotal span:last-child').text('$' + number_format(cartData.subtotal, 0,
                            ',', '.'));
                        $('.total span:last-child').text('$' + number_format(cartData.total_pedido, 0,
                            ',', '.'));


                        $.each(cartData.descuentos, function(id, descuento) {
                            $('.descuento[data-product-id="' + id + '"] span:last-child').text(
                                '$' + number_format(descuento, 0, ',', '.'));
                        });

                        $('#subtotal').val(cartData.subtotal);
                        $('#total_pedido').val(cartData.total_pedido);
                        bindCartButtons();
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
                $('.cart-summary .sumar, .carrito-slide .sumar').off('click').on('click', function() {
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

                $('.cart-summary .restar, .carrito-slide .restar').off('click').on('click', function() {
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

            // Llamar a updateCartContent al cargar la página
            updateCartContent();
            bindCartButtons();
        });
    </script>

</x-home>
