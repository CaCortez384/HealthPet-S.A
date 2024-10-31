<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vet San Agustin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>

    <!-- Bootstrap 4 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Google Material Symbols Sharp font -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Sharp" rel="stylesheet">

    <!-- Google Material Symbols Outlined font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Material Web Components -->
    <script src="https://esm.run/@material/web/all.js" type="module"></script>

    <!-- Boxicons CSS for icons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" rel="stylesheet">


    <link href="{{ asset('css\layout-home-style\layout-home.css') }}" rel="stylesheet">
</head>




<body>

    <script>
        // ---------Responsive-navbar-active-animation-----------
        function test() {
            var tabsNewAnim = $('#navbarSupportedContent');
            var selectorNewAnim = $('#navbarSupportedContent').find('li').length;
            var activeItemNewAnim = tabsNewAnim.find('.active');
            var activeWidthNewAnimHeight = activeItemNewAnim.innerHeight();
            var activeWidthNewAnimWidth = activeItemNewAnim.innerWidth();
            var itemPosNewAnimTop = activeItemNewAnim.position();
            var itemPosNewAnimLeft = activeItemNewAnim.position();
            $(".hori-selector").css({
                "top": itemPosNewAnimTop.top + "px",
                "left": itemPosNewAnimLeft.left + "px",
                "height": activeWidthNewAnimHeight + "px",
                "width": activeWidthNewAnimWidth + "px"
            });
            $("#navbarSupportedContent").on("click", "li", function(e) {
                $('#navbarSupportedContent ul li').removeClass("active");
                $(this).addClass('active');
                var activeWidthNewAnimHeight = $(this).innerHeight();
                var activeWidthNewAnimWidth = $(this).innerWidth();
                var itemPosNewAnimTop = $(this).position();
                var itemPosNewAnimLeft = $(this).position();
                $(".hori-selector").css({
                    "top": itemPosNewAnimTop.top + "px",
                    "left": itemPosNewAnimLeft.left + "px",
                    "height": activeWidthNewAnimHeight + "px",
                    "width": activeWidthNewAnimWidth + "px"
                });
            });
        }
        $(document).ready(function() {
            setTimeout(function() {
                test();
            });
        });
        $(window).on('resize', function() {
            setTimeout(function() {
                test();
            }, 500);
        });
        $(".navbar-toggler").click(function() {
            $(".navbar-collapse").slideToggle(300);
            setTimeout(function() {
                test();
            });
        });



        // --------------add active class-on another-page move----------
        jQuery(document).ready(function($) {
            // Get current path and find target link
            var path = window.location.pathname.split("/").pop();

            // Account for home page with empty path
            if (path == '') {
                path = 'index.html';
            }

            var target = $('#navbarSupportedContent ul li a[href="' + path + '"]');
            // Add active class to target link
            target.parent().addClass('active');
        });




        // Add active class on another page linked
        // ==========================================
        // $(window).on('load',function () {
        //     var current = location.pathname;
        //     console.log(current);
        //     $('#navbarSupportedContent ul li a').each(function(){
        //         var $this = $(this);
        //         // if the current path is like this link, make it active
        //         if($this.attr('href').indexOf(current) !== -1){
        //             $this.parent().addClass('active');
        //             $this.parents('.menu-submenu').addClass('show-dropdown');
        //             $this.parents('.menu-submenu').parent().addClass('active');
        //         }else{
        //             $this.parent().removeClass('active');
        //         }
        //     })
        // });
    </script>



    <!--Main Navigation-->
    <header style="background-color: rgb(73, 97, 194)">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <!-- Jumbotron -->
        <div class="p-3 text-center border-bottom ">
            <div class="container">
                <div class="row">
                    <!-- Left elements -->
                    <div class="col-md-4 d-flex justify-content-center justify-content-md-start mb-3 mb-md-0">
                        <a href="{{ route('home') }}" class="ms-md-2">
                            <img src="{{ asset('img/logo-vet.png') }}" height="80" alt="Logo">
                        </a>
                    </div>
                    <!-- Left elements -->

                    <!-- Center elements -->
                    <div class="col-md-4" style="margin-top: 20px;">
                        <form class="d-flex input-group w-auto my-auto mb-3 mb-md-0">
                            <input autocomplete="off" type="search" class="form-control rounded"
                                placeholder="Search" />
                            <button type="button" class="btn btn-warning">buscar</button>
                        </form>
                    </div>
                    <!-- Center elements -->

                    <!-- Right elements -->
                    <div class="col-md-4 d-flex justify-content-center justify-content-md-end align-items-center">
                        <div class="d-flex">

                            <!-- User -->

                            <div class="nav_link dropdown" style="margin-right: 40px;">
                                <a href="#" id="inventarioDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    style="text-decoration: none; color: white; display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                    <md-icon>account_circle</md-icon>
                                    <span class="nav_name">Mi Cuenta</span>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="inventarioDropdown"
                                    style="background-color: #e8def8; color: var(--md-sys-color-on-primary); border-radius: 20px; box-shadow: var(--md-sys-elevation-3);">

                                    {{-- Menú para usuarios no autenticados --}}
                                    @guest
                                        <li><a class="dropdown-item" href="{{ route('login') }}"
                                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Inicia
                                                Sesión</a></li>
                                        <li><a class="dropdown-item" href="{{ route('registro') }}"
                                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Registrarse</a>
                                        </li>
                                        <li><a class="dropdown-item" href=""
                                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Seguimiento</a>
                                        </li>
                                    @endguest

                                    {{-- Menú para usuarios autenticados --}}
                                    @auth
                                        <li><a class="dropdown-item" href="#"
                                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Mi
                                                Perfil</a></li>
                                        <li><a class="dropdown-item" href="{{ route('logout') }}"
                                                style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Cerrar
                                                Sesión</a></li>

                                        {{-- Formulario para cerrar sesión --}}

                                    @endauth

                                </ul>
                            </div>


                            <!-- Cart -->
                            <div class="nav_link dropdown">
                                <a href="#" id="inventarioDropdown" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false"
                                    style="text-decoration: none; color: white;display: flex; align-items: center; justify-content: center;  flex-direction: column;">
                                    <md-icon>shopping_cart</md-icon>
                                    <span class="nav_name">Carrito</span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="inventarioDropdown"
                                    style="background-color: #e8def8; color: var(--md-sys-color-on-primary); border-radius: 20px; box-shadow: var(--md-sys-elevation-3);">
                                    <li><a class="dropdown-item" href=""
                                            style="color: var(--md-sys-color-on-primary); padding: 10px 20px; border-radius: 20px;">Ver
                                            Carrito</a></li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Right elements -->
            </div>
        </div>

        <!-- Jumbotron -->

        <!-- Navbar -->
        <nav class="navbar navbar-expand-custom navbar-mainbg ">


            <div class="collapse navbar-collapse" id="navbarSupportedContent"
                style="display: flex;justify-content: center; align-items: center; ">
                <ul class="navbar-nav ml-auto">
                    <div class="hori-selector">
                        <div class="left"></div>
                        <div class="right"></div>
                    </div>
                    <li class="nav-item {{ Request::routeIs('prueba1') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('prueba1') }}"><i
                                class="fas fa-tachometer-alt"></i>Dashboard</a>
                    </li>
                    <li class="nav-item {{ Request::routeIs('home') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('home') }}"><i class="far fa-address-book"></i>Address
                            Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('petshop') }}"><i class="far fa-clone"></i>PetShop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);"><i
                                class="far fa-calendar-alt"></i>Calendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);"><i class="far fa-chart-bar"></i>Charts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0);"><i class="far fa-copy"></i>Documents</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Navbar -->




    </header>
    <!--Main Navigation-->

    <div id="contenido-home">
        {{ $slot }}
    </div>



    <!-- Remove the container if you want to extend the Footer to full width. -->
    <div>
        <!-- Footer -->
        <footer class="text-center text-lg-start text-white" style="background-color: #929fba">
            <!-- Grid container -->
            <div class="container p-4 pb-0">
                <!-- Section: Links -->
                <section class="">
                    <!--Grid row-->
                    <div class="row">
                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">
                                Company name
                            </h6>
                            <p>
                                Here you can use rows and columns to organize your footer
                                content. Lorem ipsum dolor sit amet, consectetur adipisicing
                                elit.
                            </p>
                        </div>
                        <!-- Grid column -->

                        <hr class="w-100 clearfix d-md-none" />

                        <!-- Grid column -->
                        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Products</h6>
                            <p>
                                <a class="text-white">MDBootstrap</a>
                            </p>
                            <p>
                                <a class="text-white">MDWordPress</a>
                            </p>
                            <p>
                                <a class="text-white">BrandFlow</a>
                            </p>
                            <p>
                                <a class="text-white">Bootstrap Angular</a>
                            </p>
                        </div>
                        <!-- Grid column -->

                        <hr class="w-100 clearfix d-md-none" />

                        <!-- Grid column -->
                        <hr class="w-100 clearfix d-md-none" />

                        <!-- Grid column -->
                        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                            <p><i class="fas fa-home mr-3"></i> New York, NY 10012, US</p>
                            <p><i class="fas fa-envelope mr-3"></i> info@gmail.com</p>
                            <p><i class="fas fa-phone mr-3"></i> + 01 234 567 88</p>
                            <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p>
                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                            <h6 class="text-uppercase mb-4 font-weight-bold">Follow us</h6>

                            <!-- Facebook -->
                            <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998"
                                href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

                            <!-- Twitter -->
                            <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee"
                                href="#!" role="button"><i class="fab fa-twitter"></i></a>

                            <!-- Google -->
                            <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39"
                                href="#!" role="button"><i class="fab fa-google"></i></a>

                            <!-- Instagram -->
                            <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac"
                                href="#!" role="button"><i class="fab fa-instagram"></i></a>

                            <!-- Linkedin -->
                            <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca"
                                href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
                            <!-- Github -->
                            <a class="btn btn-primary btn-floating m-1" style="background-color: #333333"
                                href="#!" role="button"><i class="fab fa-github"></i></a>
                        </div>
                    </div>
                    <!--Grid row-->
                </section>
                <!-- Section: Links -->
            </div>
            <!-- Grid container -->

            <!-- Copyright -->
            <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
                © 2024 Copyright:
                <a class="text-white" href="#">Robocop.inc</a>
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </div>
    <!-- End of .container -->
</body>







</html>
