<x-app-layout>
    <div style="background: white; margin-top: 10px; border-radius: 20px; padding: 20px;">
        <div>
          <h1>Agregar producto</h1>
          <p>Aqui va el formulario de creacion</p>
        <form action="/inventario" method="POST">
            @csrf
            <div>
                <label for="nombre">Nombre del producto:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>
            <div>
                <label for="codigo">Codigo</label>
                <input type="number" name="codigo" id="codigo">
            </div>
            <div>
                <label for="precio de compra">Precio de compra:</label>
                <input type="number" id="precio_de_compra" name="precio_de_compra" step="0.01" required>
            </div>
            <div>
                <label for="precio de compra">Precio de venta:</label>
                <input type="number" id="precio_de_venta" name="precio_de_venta" step="0.01" required>
            </div>
            <div>
                <label for="Unidades">Unidades ml, kg, L :</label>
                <input type="text" id="unidades" name="unidades" required>
            </div>
            <div>
                <label for="Stock">Stock:</label>
                <input type="number" id="stock" name="stock" step="0.01" required>
            </div>
            <div>
                <label for="fecha de vencimiento">Fecha de Expiración:</label>
                <input type="date" id="fecha_de_vencimiento" name="fecha_de_vencimiento" required>
            </div>
            <div>
                <label for="cantidad minima requerida">Cantidad minima requerida:</label>
                <input type="number" id="cantidad_minima_requerida" name="cantidad_minima_requerida" required>
            <div>
                <button type="submit">Agregar Producto</button>
            </div>
        </form>
        
        </div>
      </div>


</x-app-layout>    