@if (count($cart) > 0)
    @foreach ($cart as $id => $details)
        <?php $subtotal = $details['precio'] * $details['quantity']; ?>
        <li class="producto">
            <div class="card">
                <div class="card-body">
                    <img src="{{ asset('storage/' . $details['imagen']) }}" alt="{{ $details['nombre'] }}"
                        class="imagen-producto">
                    <div class="detalles-producto">
                        <span class="nombre">{{ $details['nombre'] }}</span>
                        <span class="precio">${{ $details['precio'] }}</span>
                        <div class="cantidad">
                            <button class="restar material-symbols-outlined"
                                data-id="{{ $id }}">remove</button>
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
