<x-app-layout>
    <div style="background: white; margin-top: 10px; border-radius: 20px; padding: 20px;">
        <div>
          <h1>Buscar producto</h1>
          <p>aqui va el formulario</p>
        
        </div>
      </div>

      <div style="background: white; margin-top: 10px; border-radius: 20px; padding: 20px;">
        <div>
          <h1>Listado de productos</h1>
          <button>nuevo</button>
          <p>aqui va la lista de productos</p>
          <table>
            <thead>
              <tr>
                <th>Producto</th>
                <th>Codigo</th>
                <th>Precio de compra</th>
                <th>Precio de venta</th>
                <th>Cantidad</th>
                <th>Categoria</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($productos as $producto)
                <tr>
                  <td>{{ $producto->nombre }}</td>
                  <td>{{ $producto->codigo }}</td>
                  <td>{{ $producto->precio_de_compra }}</td>
                  <td>{{ $producto->precio_de_venta }}</td>
                  <td>{{ $producto->stock }}</td>
                  <td>{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                  <td>
                    <button><a href="/inventario/editar">Editar</a></button>
                    <button>eliminar</button>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
</x-app-layout>    