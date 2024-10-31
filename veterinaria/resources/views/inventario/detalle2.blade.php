<x-app-layout>
    <link href="{{ asset('css/detalle2-producto-style.css') }}" rel="stylesheet">


    <div class="contenedor">
        <div class="top-container">
            <div class="product-details-container">
                <div id="volver-titulo">
                    <a href="{{ route('listar.productos') }}">
                        <md-icon-button id="openDialogButton">
                            <md-icon>arrow_back</md-icon>
                        </md-icon-button>
                    </a>
                </div>
                <!-- Encabezado: Nombre del producto y botones -->
                <div class="header2">
                    <div class="product-name">
                        <h2>{{ $producto->nombre }}</h2>
                    </div>
                    <div class="buttons">
                        <a href="{{ route('editar.producto', ['producto' => $producto->id]) }}">
                            <md-fab size="small" aria-label="Edit">
                                <md-icon slot="icon">edit</md-icon>
                            </md-fab>
                        </a>
                        <!-- Botón para dialogo alerta eliminar -->
                        <a id="openDialogButton_{{ $producto->id }}">
                            <md-fab class="boton-tabla" size="small" aria-label="Delete">
                                <md-icon slot="icon">delete</md-icon>
                            </md-fab>
                        </a>
                        {{-- <button class="cart-button">🛒 Añadir al carrito</button> --}}
                    </div>
                </div>

                <!-- Separación por línea -->
                <hr class="divider">

                <!-- Detalles de precios y stock -->
                <div class="pricing-stock">
                    <div class="purchase-price">
                        <p>Precio de compra</p>
                        <h3>${{ $producto->precio_de_compra }}</h3>
                    </div>
                    <div class="sale-price">
                        <p>Precio de venta</p>
                        <h3>${{ $producto->precio_de_venta }}</h3>
                    </div>
                    <div class="stock-info">
                        <p>Stock actual</p>
                        <h3>{{ $producto->stock_unidades }}</h3>
                        <p>Stock mínimo: {{ $producto->cantidad_minima_requerida }}</p>
                    </div>

                    @if ($producto->id_presentacion)
                        @if ($producto->id_presentacion == 1)
                            <div class="stock-info">
                                <p>Stock comprimidos</p>
                                <h3>{{ $producto->stock_total_comprimidos }}</h3>
                            </div>
                            <div class="stock-info">
                                <p>Valor fraccionado</p>
                                <h3>{{ $producto->precio_fraccionado }} c/u</h3>
                            </div>
                            <div class="stock-info">
                                <p>Comprimidos por caja</p>
                                <h3>{{ $producto->comprimidos_por_caja }} c/u</h3>
                            </div>
                        @elseif($producto->id_presentacion == 2)
                            <div class="stock-info">
                                <p>Stock mL</p>
                                <h3>{{ $producto->stock_total_ml }} mL</h3>
                            </div>
                            <div class="stock-info">
                                <p>Valor fraccionado</p>
                                <h3>{{ $producto->precio_fraccionado }} c/u</h3>
                            </div>
                            <div class="stock-info">
                                <p>ML por unidad</p>
                                <h3>{{ $producto->ml_por_unidad }} mL</h3>
                            </div>
                        @elseif($producto->id_presentacion == 3)
                            <div class="stock-info">
                                <p>Stock unidades granel</p>
                                <h3>{{ $producto->unidades_granel_total }}</h3>
                            </div>
                            <div class="stock-info">
                                <p>Valor fraccionado</p>
                                <h3>{{ $producto->precio_fraccionado }} c/u</h3>
                            </div>
                            <div class="stock-info">
                                <p>contenido por unidad</p>
                                <h3>{{ $producto->unidades_por_envase }}</h3>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="bottom-container">
        <div class="left-container">
            <div id="contenedor">
                <div class="information-section">
                    <!-- Datos de farmacia -->
                    <div class="pharmacy-data">
                        <h4>Datos de producto</h4>
                        <div class="info-cards">
                            <div class="card">
                                <p>Categoria</p>
                                <h5>{{ $producto->categoria->nombre ?? 'No especificado' }}</h5>
                            </div>
                            <div class="card">
                                <p>Presentación</p>
                                <h5>{{ $producto->presentacion->nombre ?? 'No especificado' }}</h5>
                            </div>
                            <div class="card">
                                <p>Unidades de medida</p>
                                <h5>{{ $producto->unidad->nombre ?? 'No especificado' }}</h5>
                            </div>
                            <div class="card">
                                <p>¿Disponible para venta web?</p>
                                <h5>{{ $producto->mostrar_web == 1 ? 'Sí' : ($producto->mostrar_web == 0 ? 'No' : 'No especificado') }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="right-container">
            <div id="contenedor">
                <div class="other-info">
                    <h4>Otra información</h4>
                    <div class="info-cards">
                        <div class="card">
                            <p>Código interno</p>
                            <h5>{{ $producto->codigo }}</h5>
                        </div>
                        <div class="card">
                            <p>Vencimiento</p>
                            <h5>{{ $producto->fecha_de_vencimiento ? $producto->fecha_de_vencimiento->format('d/m/Y') : 'No especificado' }}
                            </h5>
                        </div>
                        <div class="card">
                            <p>Fecha de Creación</p>
                            <h5>{{ $producto->created_at->format('d/m/Y') }}</h5>
                        </div>
                        <div class="card">
                            <p>Fecha de ultima actualizacion</p>
                            <h5>{{ $producto->updated_at->format('d/m/Y') }}</h5>
                        </div>
                        <div class="card">
                            <p>Descripción</p>
                            <h5>{{ $producto->descripcion }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <md-dialog id="dialog_{{ $producto->id }}">
            <div slot="headline">
                Eliminar Producto "{{ $producto->nombre }}"
            </div>
            <form slot="content" id="form-id-{{ $producto->id }}" method="POST"
                action="{{ route('eliminar.producto', $producto->id) }}">
                @csrf
                @method('DELETE')
                ¿Está seguro que desea eliminar el producto?
            </form>
            <div slot="actions">
                <md-text-button id="closeButton_{{ $producto->id }}">Cancelar</md-text-button>

                {{-- Botón para confirmar la eliminación del producto --}}
                <md-text-button type="submit" form="form-id-{{ $producto->id }}">Eliminar</md-text-button>
            </div>
        </md-dialog>

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                // Obtener el botón y el diálogo con el id específico del producto
                const openDialogButton_{{ $producto->id }} = document.getElementById(
                    'openDialogButton_{{ $producto->id }}');
                const dialog_{{ $producto->id }} = document.getElementById('dialog_{{ $producto->id }}');
                const closeButton_{{ $producto->id }} = document.getElementById(
                    'closeButton_{{ $producto->id }}');

                // Añadir el evento para abrir el diálogo
                openDialogButton_{{ $producto->id }}.addEventListener('click', async () => {
                    await dialog_{{ $producto->id }}.show(); // Abre el diálogo correspondiente
                });

                // Añadir el evento para cerrar el diálogo
                closeButton_{{ $producto->id }}.addEventListener('click', async () => {
                    await dialog_{{ $producto->id }}.close(); // Cierra el diálogo correspondiente
                });

            });
        </script>
    </div>

    @if ($producto->mostrar_web == 1)
        <div class="web-container">
            <div id="contenedor">
                <div class="web-info">
                    <h4>Información web</h4>
                    <div class="info-cards">
                        <div class="card">
                            <p>Imagen</p>                            
                            <img src="{{ asset('storage/' . $detalleWeb->imagen) }}" alt="Imagen del producto">

                        </div>
                        <div class="card">
                            <p>Marca</p>
                            <h5>{{ $detalleWeb ? $detalleWeb->marca : '' }}</h5>
                        </div>
                        <div class="card">
                            <p>Fecha de Creación</p>
                            <h5>{{ $detalleWeb ? $detalleWeb->contenido_neto : '' }}</h5>
                        </div>
                        <div class="card">
                            <p>Descripción</p>
                            <h5>{{ $detalleWeb ? $detalleWeb->descripcion : '' }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</x-app-layout>
