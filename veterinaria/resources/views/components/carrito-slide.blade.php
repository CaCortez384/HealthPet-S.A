<div class="carrito-slide">
    <h2>Carrito de Compras</h2>
    <ul class="lista-productos">
        @foreach($productos as $producto)
            <li class="producto">
                <span class="nombre">{{ $producto->nombre }}</span>
                <span class="precio">{{ $producto->precio }} €</span>
                <div class="cantidad">
                    <button class="restar" onclick="actualizarCantidad('{{ $producto->id }}', -1)">-</button>
                    <span>{{ $producto->cantidad }}</span>
                    <button class="sumar" onclick="actualizarCantidad('{{ $producto->id }}', 1)">+</button>
                </div>
                <button class="eliminar" onclick="eliminarProducto('{{ $producto->id }}')">Eliminar</button>
            </li>
        @endforeach
    </ul>
    <button class="pagar" onclick="irAPagar()">Pagar</button>
</div>

<script>
    function actualizarCantidad(productoId, cambio) {
        // Lógica para actualizar la cantidad del producto
    }

    function eliminarProducto(productoId) {
        // Lógica para eliminar el producto del carrito
    }

    function irAPagar() {
        // Lógica para redirigir a la página de pago
    }
</script>

<style>
    .carrito-slide {
        width: 300px;
        padding: 20px;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
    }
    .lista-productos {
        list-style-type: none;
        padding: 0;
    }
    .producto {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    .nombre, .precio, .cantidad {
        margin-right: 10px;
    }
    .cantidad {
        display: flex;
        align-items: center;
    }
    .cantidad button {
        margin: 0 5px;
    }
    .eliminar {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
    }
    .pagar {
        width: 100%;
        padding: 10px;
        background-color: green;
        color: white;
        border: none;
        cursor: pointer;
    }
</style>