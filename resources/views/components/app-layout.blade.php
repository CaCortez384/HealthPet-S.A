<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">

    <!-- Local CSS file for layout styles -->
    <link href="{{ asset('css\layout-style.css') }}" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- Boxicons CSS for icons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">

    <!-- jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous"></script>

    <!-- Google Material Symbols Sharp font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Sharp" rel="stylesheet">

    <!-- Google Material Symbols Outlined font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Material Web Components -->
    <script src="https://esm.run/@material/web/all.js" type="module"></script>

    <!-- Preconnect to Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <!-- Preconnect to Google Fonts' static content delivery network -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Material Design Filled Select CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/@material/web@latest/md-filled-select/md-filled-select.min.css">

    <!-- Custom CSS for product list styling -->
    <link href="{{ asset('css\lista-productos-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css\lista-usuario-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css\ventas\lista-ventas-style.css') }}" rel="stylesheet">
    
    <title>Vet</title>

</head>

<link href="{{ asset('css\layout-style.css') }}" rel="stylesheet">

<body id="body-pd">



    <md-fab id="menu-toggle" size="small" aria-label="Edit">
        <md-icon slot="icon">more</md-icon>
    </md-fab>

    <!-- nav busqueda -->
    <div class="header" id="header">
        <nav class="navbar navbar-expand-lg " id="navbar">
            <div class="container-fluid">

                <div class="dropdown">
                    <md-fab variant="secondary" aria-label="add" class="dropdown-toggle" id="headerDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false"
                        style="--md-fab-after-display: none;">
                        <md-icon slot="icon">add</md-icon>
                    </md-fab>
                    <ul class="dropdown-menu" aria-labelledby="inventarioDropdown"
                        style="background-color: #e8def8; color: var(--md-sys-color-on-primary); border-radius: 20px; box-shadow: var(--md-sys-elevation-3);">
                        <li><a class="dropdown-item" href="{{ route('inventario.crear') }}"
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Nuevo
                                producto</a></li>
                        <li><a class="dropdown-item" href="{{ route('ventas.create') }}"
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Nueva
                                venta</a></li>
                        <li><a class="dropdown-item" href="{{ route('deudas.index') }}"
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Deudores</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('registro-admin') }}"
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Nuevo
                                administrador</a></li>
                    </ul>
                </div>



                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>


                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item" id="item-buscar">
                            <form id="form-busqueda" role="search">
                                <input class="form-control me-2" id="buscador" type="search" placeholder="Buscar producto"
                                    aria-label="Search">
                                <button class="btn" id="boton-busc" type="submit">
                                    <md-icon slot="icon">search</md-icon>
                                </button>
                            </form>
                            <!-- Contenedor para los resultados -->
                            <ul id="resultados-busqueda" class="list-group"
                                style="position: absolute; z-index: 1000; display: none; width: 100%;"></ul>
                        </li>
                    </ul>
                </div>
                <script>
                    document.getElementById('buscador').addEventListener('input', function() {
                        const query = this.value.trim();
                        const resultadosContainer = document.getElementById('resultados-busqueda');

                        if (query) {
                            // Realizar solicitud AJAX
                            fetch(`/buscar?query=${encodeURIComponent(query)}`)
                                .then(response => response.json())
                                .then(resultados => {
                                    // Limpiar resultados previos
                                    resultadosContainer.innerHTML = '';

                                    if (resultados.length > 0) {
                                        resultados.forEach(resultado => {
                                            const item = document.createElement('li');
                                            item.className = 'list-group-item';

                                            if (resultado.tipo === 'producto') {
                                                item.textContent = `${resultado.nombre} - $${resultado.precio}`;
                                            } else if (resultado.tipo === 'deuda') {
                                                item.textContent = `${resultado.descripcion} - $${resultado.monto}`;
                                            }

                                            item.addEventListener('click', () => {
                                                // Redirigir al detalle del resultado
                                                if (resultado.tipo === 'producto') {
                                                    window.location.href =
                                                        `{{ url('inventario/detalle2') }}/${resultado.id}`;
                                                } else if (resultado.tipo === 'deuda') {
                                                }
                                            });

                                            resultadosContainer.appendChild(item);
                                        });

                                        // Mostrar el listado
                                        resultadosContainer.style.display = 'block';
                                    } else {
                                        resultadosContainer.style.display = 'none';
                                    }
                                })
                                .catch(error => console.error('Error en la búsqueda:', error));
                        } else {
                            // Ocultar resultados si el campo está vacío
                            resultadosContainer.style.display = 'none';
                        }
                    });

                    // Cerrar el listado flotante si el usuario hace clic fuera
                    document.addEventListener('click', function(event) {
                        const resultadosContainer = document.getElementById('resultados-busqueda');
                        if (!event.target.closest('#item-buscar')) {
                            resultadosContainer.style.display = 'none';
                        }
                    });
                </script>


                <div style="margin-right: 50px; position: relative;">
                    <a href="#" id="inventarioDropdown1" role="button" aria-expanded="false">
                        <md-fab class="boton-tabla" size="small" aria-label="Imprimir">
                            <md-icon slot="icon">notifications</md-icon>
                            @if ($productosBajoStock->count() > 0)
                                <span class="badge"
                                    style="position: absolute; top: 0; right: 0; background-color: red; color: white; border-radius: 50%; padding: 5px; font-size: 12px;">
                                    {{ $productosBajoStock->count() }}
                                </span>
                            @endif
                        </md-fab>
                    </a>

                    <ul class="dropdown-menu a" aria-labelledby="inventarioDropdown1"
                        style="background-color: #f5f5f5; color: #333; border-radius: 20px; 
                            box-shadow: var(--md-sys-elevation-3); display: none; 
                            max-height: 300px; overflow-y: auto; padding: 10px; 
                            margin-left: -188px; /* Sin margen izquierdo para acercarlo a la izquierda */
                            width: 300px;">

                        <li style="font-weight: bold; font-size: 18px; margin-bottom: 10px;">
                            Notificaciones de Stock Bajo
                        </li>

                        @if ($productosBajoStock->count() > 0)
                            @foreach ($productosBajoStock as $producto)
                                <li style="padding: 10px; background-color: #fff; 
                                        border-radius: 10px; margin: 5px 0; 
                                        display: flex; align-items: center; 
                                        border: 1px solid #ddd; cursor: pointer;"
                                    onclick="window.location='{{ route('detalle2.producto', ['id' => $producto->id]) }}'"
                                    onmouseover="this.style.backgroundColor='#f0f0f0';"
                                    onmouseout="this.style.backgroundColor='#fff';">

                                    <i class="fas fa-exclamation-triangle"
                                        style="color: orange; margin-right: 10px;"></i>

                                    <div>
                                        <strong>{{ $producto->nombre }}</strong> -
                                        <span style="color: red;">Stock: {{ $producto->stock_unidades }}</span>
                                        (Mínimo requerido: {{ $producto->cantidad_minima_requerida }})
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li style="padding: 10px; background-color: #fff; border-radius: 10px; margin: 5px 0;">
                                No hay productos con stock bajo.
                            </li>
                        @endif
                    </ul>
                </div>


                <script>
                    // Control del evento click en el botón del dropdown
                    document.getElementById('inventarioDropdown1').addEventListener('click', function(event) {
                        event.preventDefault(); // Evita el comportamiento por defecto del enlace

                        // Selecciona el menú dropdown actual
                        const dropdownMenu = this.nextElementSibling;

                        // Cierra otros dropdowns abiertos
                        document.querySelectorAll('.dropdown-menu-a').forEach(function(menu) {
                            if (menu !== dropdownMenu) {
                                menu.style.display = 'none'; // Cierra otros dropdowns
                            }
                        });

                        // Alterna la visibilidad del menú dropdown actual
                        if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
                            dropdownMenu.style.display = 'block';
                        } else {
                            dropdownMenu.style.display = 'none';
                        }
                    });

                    // Evita que el menú se cierre al hacer clic en un ítem
                    document.querySelectorAll('.dropdown-menu-a').forEach(function(item) {
                        item.addEventListener('click', function(event) {
                            event.stopPropagation(); // Detiene la propagación del clic para que no cierre el menú
                        });
                    });

                    // Cierra el dropdown si se hace clic fuera
                    document.addEventListener('click', function(event) {
                        const dropdown = document.getElementById('inventarioDropdown1');
                        const dropdownMenu = dropdown.nextElementSibling;

                        // Cierra el menú solo si el clic ocurre fuera del dropdown
                        if (!dropdown.contains(event.target)) {
                            dropdownMenu.style.display = 'none';
                        }
                    });
                </script>



                <div id="usuario">
                    @auth
                        <div id="user-data">
                            <h6>Hola {{ ucwords(strtolower(Auth::user()->name)) }}</h6>
                            <!-- Primera letra mayúscula y demás en minúscula -->
                            <a href="{{ route('logout') }}">
                                Cerrar Sesi&oacute;n
                                <md-icon slot="icon" style="  --md-icon-size: 13px;">power_settings_new</md-icon></a>
                        </div>

                        <img id="avatar"
                            src="https://media.istockphoto.com/id/1005374612/vector/dog-paw-icon-logo.jpg?s=612x612&w=0&k=20&c=Rtyzn4JwMla0IMrbO-6s2GohBpYO9g-N8_B2CDI118E="
                            alt="">
                    @endauth
                </div>

            </div>
    </div>
    </nav>
    </div>

    <!-- Sidebar -->
    <div class="l-navbar" id="nav-bar">
        <div class="nav" id="nav">

            <div id="logo">
                <a href="{{ route('inicio') }}" class="nav_logo">
                    <img src="/img/logo.png" alt="Logo" class="nav_logo-icon"
                        style="width: 80px; height: 80px;">
                </a>

            </div>


            <div class="nav_list">

                <a href="{{ route('inicio') }}" class="nav_link active">
                    <i class='bx bx-grid-alt'></i>
                    <span class="nav_name">Inicio</span>
                </a>


                <div class="nav_link dropdown">
                    <a href="#" class="dropdown-toggle" id="inventarioDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-box'></i>
                        <span class="nav_name">Inventario</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="inventarioDropdown"
                        style="background-color: #e8def8; color: var(--md-sys-color-on-primary); border-radius: 20px; box-shadow: var(--md-sys-elevation-3);">
                        <li><a class="dropdown-item" href="{{ route('inventario.crear') }}"
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Nuevo
                                producto</a></li>
                        <li><a class="dropdown-item" href="{{ route('listar.productos') }}"
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Lista
                                de productos</a></li>
                    </ul>
                </div>

                <div class="nav_link dropdown">
                    <a href="#" class="dropdown-toggle" id="ventasDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-box'></i>
                        <span class="nav_name">Ventas</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="ventasDropdown"
                        style="background-color: #e8def8; color: var(--md-sys-color-on-primary); border-radius: 20px; box-shadow: var(--md-sys-elevation-3);">
                        <li><a class="dropdown-item" href="{{ route('ventas.create') }}"
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Nueva
                                venta</a></li>
                        <li><a class="dropdown-item" href="{{ route('ventas.index') }}"
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Historial
                                de ventas</a></li>
                        <li><a class="dropdown-item" href="{{ route('deudas.index') }}"
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Deudores</a>
                        </li>
                    </ul>
                </div>
                {{-- 
                <div class="nav_link dropdown">
                    <a href="#" class="dropdown-toggle" id="inventarioDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-time'></i>
                        <span class="nav_name">Citas</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="inventarioDropdown"
                        style="background-color: #e8def8; color: var(--md-sys-color-on-primary); border-radius: 20px; box-shadow: var(--md-sys-elevation-3);">
                        <li><a class="dropdown-item" href=""
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Nueva
                                cita</a></li>
                        <li><a class="dropdown-item" href=""
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Proximas
                                citas</a></li>
                    </ul>
                </div> --}}
                <div class="nav_link dropdown">
                    <a href="#" class="dropdown-toggle" id="inventarioDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx bx-time'></i>
                        <span class="nav_name">Pedidos</span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="inventarioDropdown"
                        style="background-color: #e8def8; color: var(--md-sys-color-on-primary); border-radius: 20px; box-shadow: var(--md-sys-elevation-3);">
                        <li><a class="dropdown-item" href="{{ route('pedidos.index') }}"
                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Lista
                                de pedidos</a></li>
                    </ul>
                </div>


                @auth
                    @if (auth()->user()->role === 'editor')
                        <div class="nav_link dropdown">
                            <a href="#" class="dropdown-toggle" id="inventarioDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class='bx bx-user'></i>
                                <span class="nav_name">Usuarios</span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="inventarioDropdown"
                                style="background-color: #e8def8; color: var(--md-sys-color-on-primary); border-radius: 20px; box-shadow: var(--md-sys-elevation-3);">
                                <li><a class="dropdown-item" href="{{ route('registro-admin') }}"
                                        style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Nuevo
                                        Administrador</a></li>
                                <li><a class="dropdown-item" href="{{ route('listar.usuarios') }}"
                                        style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Lista
                                        de Usuarios</a></li>
                            </ul>
                        </div>
                    @endif
                @endauth




            </div>

        </div>
    </div>

    <div id="contenido">
        {{ $slot }}
    </div>

    <script src="{{ asset('js\layout-js.js') }}"></script>
</body>

</html>
