<x-home>
    <x-menu-user>

       

            <div class="container mt-5">
                <!-- Título y descripción -->
                <h1 class="mb-3">Mis Pedidos</h1>
                <p class="text-muted">Aquí encontrarás un historial de todos tus pedidos. Puedes buscar por el número de pedido o filtrar por el estado del pedido (Completado o Pendiente).</p>
            

    <!-- Filtro de búsqueda -->
    <div class="row mb-4">
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Buscar por N° de pedido">
        </div>
        <div class="col-md-4">
            <select class="form-select">
                <option value="">Filtrar por Estado</option>
                <option value="completado">Completado</option>
                <option value="pendiente">Pendiente</option>
            </select>
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary w-100">Aplicar Filtro</button>
        </div>
    </div>
                <hr>
            
                <!-- Tabla de pedidos -->
                <div class="accordion" id="ordersAccordion">
                    <!-- Ejemplo de un pedido -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="order1">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrder1" aria-expanded="true" aria-controls="collapseOrder1">
                                <div class="row w-100">
                                    <div class="col-md-2"><strong>N°:</strong> 2121</div>
                                    <div class="col-md-2"><strong>Fecha:</strong> 2024-11-07</div>
                                    <div class="col-md-2"><strong>Items:</strong> 5</div>
                                    <div class="col-md-3"><strong>Total:</strong> $150.00</div>
                                    <div class="col-md-3"><strong>Estado:</strong> Completado</div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseOrder1" class="accordion-collapse collapse" aria-labelledby="order1" data-bs-parent="#ordersAccordion">
                            <div class="accordion-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Producto A</td>
                                            <td>2</td>
                                            <td>$20.00</td>
                                            <td>$40.00</td>
                                        </tr>
                                        <tr>
                                            <td>Producto B</td>
                                            <td>3</td>
                                            <td>$15.00</td>
                                            <td>$45.00</td>
                                        </tr>
                                        <!-- Agregar más items según sea necesario -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Agrega más pedidos aquí de la misma forma -->

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="order2">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrder2" aria-expanded="true" aria-controls="collapseOrder2">
                                <div class="row w-100">
                                    <div class="col-md-2"><strong>N°:</strong> 2122</div>
                                    <div class="col-md-2"><strong>Fecha:</strong> 2024-11-07</div>
                                    <div class="col-md-2"><strong>Items:</strong> 5</div>
                                    <div class="col-md-3"><strong>Total:</strong> $150.00</div>
                                    <div class="col-md-3"><strong>Estado:</strong> Completado</div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseOrder2" class="accordion-collapse collapse" aria-labelledby="order2" data-bs-parent="#ordersAccordion">
                            <div class="accordion-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Producto A</td>
                                            <td>2</td>
                                            <td>$20.00</td>
                                            <td>$40.00</td>
                                        </tr>
                                        <tr>
                                            <td>Producto B</td>
                                            <td>3</td>
                                            <td>$15.00</td>
                                            <td>$45.00</td>
                                        </tr>
                                        <!-- Agregar más items según sea necesario -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                    <div class="accordion-item">
                        <h2 class="accordion-header" id="order3">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrder3" aria-expanded="true" aria-controls="collapseOrder3">
                                <div class="row w-100">
                                    <div class="col-md-2"><strong>N°:</strong> 2123</div>
                                    <div class="col-md-2"><strong>Fecha:</strong> 2024-11-07</div>
                                    <div class="col-md-2"><strong>Items:</strong> 5</div>
                                    <div class="col-md-3"><strong>Total:</strong> $150.00</div>
                                    <div class="col-md-3"><strong>Estado:</strong> Completado</div>
                                </div>
                            </button>
                        </h2>
                        <div id="collapseOrder3" class="accordion-collapse collapse" aria-labelledby="order3" data-bs-parent="#ordersAccordion">
                            <div class="accordion-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Producto A</td>
                                            <td>2</td>
                                            <td>$20.00</td>
                                            <td>$40.00</td>
                                        </tr>
                                        <tr>
                                            <td>Producto B</td>
                                            <td>3</td>
                                            <td>$15.00</td>
                                            <td>$45.00</td>
                                        </tr>
                                        <!-- Agregar más items según sea necesario -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
 
          

    </x-menu-user>
</x-home>