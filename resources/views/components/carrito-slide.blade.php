<link href="{{ asset('css/layout-home-style/carrito-slide.css') }}" rel="stylesheet">
<div class="carrito-slide">
    <button class="cerrar material-symbols-outlined">close</button>
    <h2>Carrito de Compras</h2>
    <ul class="lista-productos">
        <?php $total = 0; ?>
        <?php $descuento = 0; ?>
        @if (session('cart'))
            @foreach (session('cart') as $id => $details)
                <?php 
                $subtotal = is_numeric($details['precio']) && is_numeric($details['quantity']) ? $details['precio'] * $details['quantity'] : 0; 
                if ($details['stock'] == 0) {
                    $descuento = $subtotal / 2;
                } else {
                    $descuento = 0;
                }
                $total += $subtotal;
                ?>
                <li class="producto">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $details['imagen']) }}" alt="{{ $details['nombre'] }}" class="imagen-producto">
                            <div class="detalles-producto">
                                <span class="nombre">{{ $details['nombre'] }}</span>
                                <span class="precio">${{ $details['precio'] }}</span>
                                <div class="cantidad">
                                    <button class="restar material-symbols-outlined" data-id="{{ $id }}">remove</button>
                                    <span>{{ $details['quantity'] }}</span>
                                    <button class="sumar material-symbols-outlined" data-id="{{ $id }}">add</button>
                                </div>
                            </div>
                            <button class="eliminar material-symbols-outlined" data-id="{{ $id }}">delete</button>
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
    <div class="subtotal">
        <span>Subtotal:</span>
        <span>${{ number_format($total, 0, ',', '.') }}</span>
    </div>
    <div class="descuento-info">
        <span>50% de pedido</span>
  
    </div>
    <div class="informacion-descuento">
        <p>Nota: Los productos a pedido requieren un pago inicial del 50%. El monto restante se pagará al momento de retirar el producto.</p>
    </div>
    <div class="total">
        <span>Total:</span>
        <span>${{ number_format($total - $descuento, 0, ',', '.') }}</span>
    </div>
    <a href="{{ url('checkout') }}" class="pagar">Pagar</a>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carritoSlide = document.querySelector('.carrito-slide');
        const carritoButton = document.querySelector('#carritoMostrar');
        carritoButton.addEventListener('click', function() {
            carritoSlide.classList.toggle('visible');
        });
        const cerrarButton = document.querySelector('.cerrar');
        cerrarButton.addEventListener('click', function() {
            carritoSlide.classList.remove('visible');
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
                success: function(response) {
                    $('.subtotal span:last-child').text('$' + number_format(response.subtotal, 0, ',', '.'));
                    $('.descuento span:last-child').text('$' + number_format(response.descuento, 0, ',', '.'));
                    $('.total span:last-child').text('$' + number_format(response.total, 0, ',', '.'));
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
        updateCartContent();
    });
</script>