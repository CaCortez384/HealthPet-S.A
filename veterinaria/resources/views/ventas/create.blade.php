<x-app-layout>
    <div class="container">
        <h1>Generar Nueva Venta</h1>
        
        <form action="{{ route('ventas.store') }}" method="POST">
            @csrf
 
            <!-- Información del Cliente -->
            <div class="mb-3">
                <label for="nombre_cliente" class="form-label">Nombre del Cliente</label>
                <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Nombre del cliente (opcional)" >
            </div>

            <div class="mb-3">
                <label for="rut_cliente" class="form-label">RUT del Cliente</label>
                <input type="text" class="form-control" id="rut_cliente" name="rut_cliente" placeholder="RUT del cliente (opcional)" >
            </div>

         <!-- Lista de Productos -->
<div class="mb-3">
    <label for="productos" class="form-label">Productos</label>
    <select class="form-select" id="productos" name="producto[][id_producto]">
        <option value="">Seleccione un producto</option>
        @foreach($productos as $producto)
            <option value="{{ $producto->id }}" data-precio="{{ $producto->precio_de_venta }}">
                {{ $producto->nombre }} - ${{ $producto->precio_de_venta }}
            </option>
        @endforeach
    </select>
</div>
<!-- Cantidad de Producto -->
<div class="mb-3">
    <label for="cantidad" class="form-label">Cantidad</label>
    <input type="number" class="form-control" id="cantidad" name="producto[][cantidad]" value="1" min="1" required>
</div>

            <!-- Botón para agregar más productos -->
            <button type="button" class="btn btn-secondary" id="agregarProducto">Agregar otro producto</button>

            <!-- Lista de productos agregados (carrito) -->
            <div id="listaProductos"></div>

            <!-- Subtotal y total con descuento -->
            <div class="mb-3 mt-3">
                <label for="subtotal" class="form-label">Subtotal</label>
                <input type="text" class="form-control" id="subtotal" name="subtotal" readonly>
            </div>

            <div class="mb-3">
                <label for="descuento" class="form-label">Descuento (%)</label>
                <input type="number" class="form-control" id="descuento" name="descuento" value="0" min="0" max="100">
            </div>

            <div class="mb-3">
                <label for="descuento" class="form-label">monto pagado por el cliente</label>
                <input type="number" class="form-control" id="descuento" name="monto_pagado" value="0" >
            </div>

            <div class="mb-3">
                <label for="descuento" class="form-label">Nota de Venta</label>
                <input type="text" class="form-control" id="descuento" name="nota" >
            </div>

            <div class="mb-3">
                <label for="total" class="form-label">Total</label>
                <input type="text" class="form-control" id="total" name="total" readonly>
            </div>

            <button type="submit" class="btn btn-primary">Generar Venta</button>
        </form>
    </div>

    <script>
        let productosSeleccionados = []; // Array para guardar los productos seleccionados
        let productoCounter = 0; // Contador para productos
        document.getElementById('agregarProducto').addEventListener('click', () => {
    let productoSelect = document.getElementById('productos');
    let cantidadInput = document.getElementById('cantidad');
    let productoId = productoSelect.value;
    let productoNombre = productoSelect.options[productoSelect.selectedIndex].text;
    let productoPrecio = productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precio');
    let cantidad = cantidadInput.value;

    if (productoId && cantidad > 0) {
        // Agregar producto al array
        productosSeleccionados.push({
            id: productoId,
            nombre: productoNombre,
            precio: parseFloat(productoPrecio),
            cantidad: parseInt(cantidad)
        });

        // Crear HTML para el nuevo producto
        let newProductHtml = `
            <div class="producto mb-2" id="producto-${productoCounter}">
                <p>Producto: ${productoNombre} - Cantidad: ${cantidad} - Precio: $${productoPrecio}</p>
                <button type="button" class="btn btn-danger" onclick="eliminarProducto(${productoCounter})">Eliminar</button>
                <input type="hidden" name="productos[${productoCounter}][id_producto]" value="${productoId}">
                <input type="hidden" name="productos[${productoCounter}][cantidad]" value="${cantidad}">
                <input type="hidden" name="productos[${productoCounter}][precio_unitario]" value="${productoPrecio}">
            </div>
        `;
        document.getElementById('listaProductos').insertAdjacentHTML('beforeend', newProductHtml);
        productoCounter++; // Incrementar el contador de productos

        // Actualizar el carrito
        actualizarCarrito();
    }
});
        // Función para actualizar el carrito de productos
        function actualizarCarrito() {
            let subtotal = 0;

            productosSeleccionados.forEach((producto) => {
                subtotal += producto.precio * producto.cantidad; // Sumar al subtotal
            });

            // Actualizar subtotal y total
            document.getElementById('subtotal').value = subtotal;
            actualizarTotal();
        }

        // Función para eliminar un producto del carrito
        function eliminarProducto(index) {
            productosSeleccionados.splice(index, 1); // Eliminar del array
            document.getElementById(`producto-${index}`).remove(); // Eliminar del HTML
            actualizarCarrito(); // Actualizar el carrito
        }

        // Función para actualizar el total con el descuento aplicado
        document.getElementById('descuento').addEventListener('input', actualizarTotal);
    
        function actualizarTotal() {
            let subtotal = parseFloat(document.getElementById('subtotal').value) || 0;
            let descuento = parseFloat(document.getElementById('descuento').value) || 0;
            let total = subtotal - (subtotal * (descuento / 100));
            document.getElementById('total').value = total;
        }
    </script>

</x-app-layout>
