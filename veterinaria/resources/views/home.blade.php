<x-app-layout>
    <link href="{{ asset('css/home/home-style.css') }}" rel="stylesheet">

    <div class="container mt-4">
        <h1 class="text-center mb-4">Dashboard - Datos Interesantes</h1>
        {{-- Alerta de productos bajo stock --}}
        @if ($productosBajoStock->count() > 0)
            <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
            <strong>Atención!</strong> Tienes {{ $productosBajoStock->count() }} productos con bajo stock.
            <button type="button" class="btn btn-primary btn-sm mx-2" data-bs-toggle="collapse"
                data-bs-target="#productosBajoStock">
                Ver productos
            </button>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <div id="productosBajoStock" class="collapse mt-3">
            <ul class="list-group">
                @foreach ($productosBajoStock as $producto)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $producto->nombre }}
                    <div class="d-flex align-items-center">
                    <span class="badge bg-danger me-2">Stock: {{ $producto->stock_unidades }} (Min:
                        {{ $producto->cantidad_minima_requerida }})</span>
                    <a href="{{ route('detalle2.producto', ['id' => $producto->id]) }}" class="btn btn-icon btn-sm btn-primary material-icons">
                        Ver
                    </a>
                    </div>
                </li>
                @endforeach
            </ul>
            </div>
        @endif

        {{-- Resumen del día --}}
        <div class="row mt-4 g-3">
            <div class="col-md-4">
                <div class="card text-center shadow-sm">
                    <div class="card-header bg-primary text-white">Ingresos de Hoy</div>
                    <div class="card-body">
                        <h5 class="card-title">${{ number_format($ingresosHoy, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm card-hover"
                    onclick="window.location.href='{{ route('pedidos.index') }}'">
                    <div class="card-header bg-success text-white">Nuevos Pedidos</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $nuevosPedidos }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm card-hover" onclick="window.location.href='{{ route('pedidos.index') }}'">
                    <div class="card-header bg-warning text-white">Pedidos Activos</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $pedidosActivos }}</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- Segunda fila --}}
        <div class="row mt-4 g-3">
            <div class="col-md-4">
                <div class="card text-center shadow-sm card-hover" onclick="window.location.href='{{ route('ventas.index') }}'">
                    <div class="card-header bg-info text-white">Ventas de Hoy</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ number_format($ventas, 0, ',', '.') }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm card-hover" onclick="window.location.href='{{ route('deudas.index') }}'">
                    <div class="card-header bg-danger text-white">Deudores Actuales</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $deudoresActuales }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-center shadow-sm card-hover" onclick="window.location.href='{{ route('listar.productos') }}'">
                    <div class="card-header bg-secondary text-white">Productos con Stock Bajo</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $productosBajoStock->count() }}</h5>
                    </div>
                </div>
            </div>
        </div>

        {{-- Gráfico de ventas mensuales e ingresos por tipo --}}
        <div class="grid-container mt-5">
            <div class="ventas-chart">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white text-center">
                        ingresos de ventas totales por mes
                    </div>
                    <div class="card-body">
                        <canvas id="ventasChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="ingresos-chart">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white text-center">
                        Ingresos por tipo del mes actual
                    </div>
                    <div class="card-body">
                        <canvas id="ingresosChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script para el gráfico --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1"></script>
    <script>
        let chartInstance = null;

        function obtenerDatos(tipo) {
            fetch(`/ventas/datos/${tipo}`)
                .then(response => response.json())
                .then(data => {
                    // Si el gráfico ya existe, lo destruimos para crear uno nuevo
                    if (chartInstance) {
                        chartInstance.destroy();
                    }

                    const chartData = data.data;
                    const chartLabels = data.labels;

                    const ctx = document.getElementById('ventasChart').getContext('2d');
                    chartInstance = new Chart(ctx, {
                            type: 'bar', // Tipo de gráfico, puedes cambiar a 'bar', 'pie', etc.
                            data: {
                                labels: chartLabels,
                                datasets: [{
                                    label: 'Ventas Totales',
                                    data: chartData,
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'top',
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return '$' + tooltipItem.raw.toLocaleString();
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    y: {
                                        beginAtZero: true
                                    }
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error fetching data:', error);
                        });
                });
        }

        // Función para cambiar el gráfico entre mensual y diario
        function cambiarGrafico(tipo) {
            obtenerDatos(tipo);
        }

        // Cargar el gráfico mensual por defecto
        document.addEventListener('DOMContentLoaded', function() {
            obtenerDatos('mes');
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetch('/ingresos/tipo')
                .then(response => response.json())
                .then(data => {
                    const ctx = document.getElementById('ingresosChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'pie', // Puedes usar 'bar', 'doughnut', etc.
                        data: {
                            labels: data.labels,
                            datasets: [{
                                label: 'Ingresos por Tipo',
                                data: data.data,
                                backgroundColor: [
                                    'rgba(54, 162, 235, 0.2)', // Color para ventas
                                    'rgba(255, 206, 86, 0.2)', // Color para pedidos
                                ],
                                borderColor: [
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(255, 206, 86, 1)',
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                },
                                tooltip: {
                                    enabled: true
                                }
                            }
                        }
                    });
                });
        });
    </script>


</x-app-layout>
