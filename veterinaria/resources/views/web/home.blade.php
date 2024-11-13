<x-home>
   
<head>



  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />



    

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />


  <!-- Custom styles for this template -->

  <link href="{{ asset('css\home\style.css') }}" rel="stylesheet"> 
   <!-- responsive style -->

  <link href="{{ asset('css\home\responsive.css') }}" rel="stylesheet"> 
  
</head>
<div id="todo-home">

  <style>

  .input-boxes:hover{
      cursor: url('img/cursor-gato-hover.png'), auto;
    }


    .card-item:hover{
      cursor: url('img/cursor-gato-hover.png'), auto;
    }

    .card-item> img:hover{
      cursor: url('img/cursor-gato-hover.png'), auto;
    }

    .card-item> h5:hover{
      cursor: url('img/cursor-gato-hover.png'), auto;
    }

    
    .card-item> p:hover{
      cursor: url('img/cursor-gato-hover.png'), auto;
    }
    
    
    #image-love:hover{
      cursor: url('img/cursor-gato-hover.png'), auto;
    }
    
    #image-galeria:hover{
      cursor: url('img/cursor-gato-hover.png'), auto;
    }

    #image-galeria> img:hover{
      cursor: url('img/cursor-gato-hover.png'), auto;
    }

    .carousel-indicators> li:hover{
      cursor: url('img/cursor-gato-hover.png'), auto;
    }

    /* fin hover */
    
    
    
    .client_section .client_container {
      position: relative;
        background-image: url('img/clientes/fondo-cliente.png');
      
    
    }

    
    .gallery-section {
        position: relative;
        background-image: url('img/galeria/fondo-galeria.png');
        background-size: cover;
        background-repeat: no-repeat;
        
    }
    
    .slider_section {
        position: relative;
        background: linear-gradient(to right, rgb(110, 179, 223), rgba(1, 1, 6, 0.189)), url('img/fondo-carusel.jpg');
        background-size: cover;
        background-repeat: no-repeat;
        padding: 6% 0;
      
     margin: 50px 0px 10px 0px
    }



    
        </style>
    

    
  <div >


    <!-- slider section -->


<a id="whatsapp-icon"   href="https://wa.me/56945258235?text=Hola%2C%20quiero%20hacer%20una%20consulta%20veterinaria.%20Los%20datos%20de%20mi%20mascota%20son%3A%0A%0A1.%20Nombre%20de%20la%20mascota%3A%20%5BNombre%20de%20la%20mascota%5D%0A2.%20Especie%20y%20raza%3A%20%5BEspecie%20y%20raza%5D%0A3.%20Edad%20y%20sexo%3A%20%5BEdad%20y%20sexo%5D%0A4.%20Motivo%20de%20la%20consulta%3A%20%5BMotivo%20de%20la%20consulta%5D%0A5.%20Síntomas%20observados%3A%20%5BSíntomas%20adicionales%5D%0A6.%20Tratamientos%20previos%20o%20actuales%3A%20%5BTratamientos%20previos%5D%0A7.%20Vacunas%20recientes%3A%20%5BVacunas%20recientes%5D%0A8.%20Otros%20detalles%3A%20%5BOtros%20detalles%20relevantes%5D" class="whatsapp-icon" target="_blank">
  <i class="fab fa-whatsapp"></i>
</a>

<script>
  
window.onload = function() {
  setTimeout(function() {
    document.getElementById('whatsapp-icon').style.display = 'block';
    document.getElementById('whatsapp-icon').style.opacity = 1;  // Asegura que se vea correctamente si usas la transición
  }, 5000); // 5000 ms = 5 segundos
};

</script>



<section class="slider_section ">
  <div class="col-md-4 offset-md-2" id="contenedor-carrusel">
      <div class="slider_detail-box">
          <h1>
              Cuidado profesional a tu
              <span>
                  mascota
              </span>
          </h1>
          <img src="img/pisadas-perro.png" alt="" width="300px">
          <p>
              Ponemos a disposición nuestros distintos servicios para sus mascotas queridas, donde encontraras la mejor atención, en un lugar amplio y cómodo para ellos.
          </p>
          <div class="btn-box">
              <a href="#contenedor-super" class="btn-2">
                  Contactanos
              </a>
          </div>
      </div>
  </div>

</section>
    <!-- end slider section -->
  </div>

  <!-- about section -->


  <section class="section reveal about_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="img/about-fondo.png" alt="" class="imagen" id="image-love">
    
            <span class="corazon">❤️</span>
            <span class="corazon">❤️</span>
            <span class="corazon">❤️</span>
            <span class="corazon">❤️</span>
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <h2 class="custom_heading">
              Acerca de Nuestra 
              <span>
                Veterinaria
              </span>
            </h2>
            <p>El Hospital Clínico Veterinario San Agustín fue fundado en 2015 con el compromiso de ofrecer servicios de alta calidad para el cuidado y recuperación de nuestros pacientes en un entorno adecuado y con todas las medidas sanitarias necesarias. Contamos con un equipo de profesionales altamente capacitados y un servicio de ambulancia móvil, que permite realizar visitas a domicilio y transportar a nuestros pacientes desde cualquier lugar. Nuestro hospital está autorizado por el ISP, lo que garantiza la calidad y legalidad de nuestros servicios.</p>
      
              <div class="btn-box">
                <a href="#ubicacion" class="btn-2">
                  Conoce nuestra ubicación y Horarios de Atención
                </a>
      
            </div>
            
  
          </div>
          
        </div>
      </div>
    </div>
  </section>

  <!-- Service Section -->
<!-- Service Section -->
<section class="section reveal service_section layout_padding">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <h2 class="custom_heading">
          Conoce Nuestros <span>Servicios</span>
        </h2>
        <div class="container layout_padding2">
          <div class="row">
            <div class="carousel-container1">
              <div class="carousel1">
                <!-- Tarjetas (cards) originales -->
                <div class="card-item">
                  <img src="img/servicios/peluqueria.png" alt="Peluquería">
                  <hr>
                  <h5>Peluquería</h5>
                  <p>Baño, corte de pelo, limpieza de oídos, corte de uñas y peinados especiales para mascotas.</p>
                </div>
                <div class="card-item">
                  <img src="img/servicios/consultas.png" alt="Consultas">
                  <hr>
                  <h5>Consultas</h5>
                  <p>Revisión general, control de peso, vacunación, desparasitación y asesoramiento personalizado.</p>
                </div>
                <div class="card-item">
                  <img src="img/servicios/operaciones.png" alt="Operaciones">
                  <hr>
                  <h5>Cirugías</h5>
                  <p>Esterilización, extracción de tumores, limpieza dental, cuidados pre y postoperatorios.</p>
                </div>
                <div class="card-item">
                  <img src="img/servicios/examenes.png" alt="Exámenes">
                  <hr>
                  <h5>Laboratorio</h5>
                  <p>Análisis de sangre, orina, heces, pruebas hormonales y diagnósticos avanzados.</p>
                </div>
                <div class="card-item">
                  <img src="img/servicios/hospit-hd.png" alt="Hospital">
                  <hr>
                  <h5>Hospital</h5>
                  <p>Monitoreo constante, administración de medicamentos, cuidado postoperatorio y atención veterinaria especializada.</p>
                </div>
                <div class="card-item">
                  <img src="img/servicios/radiografia.png" alt="Radiografías">
                  <hr>
                  <h5>Radiografías</h5>
                  <p>Diagnóstico preciso, imágenes detalladas, evaluación de huesos, órganos y detección de lesiones.</p>
                </div>

                <!-- Duplicar las tarjetas para crear el bucle suave -->
                <div class="card-item">
                  <img src="img/servicios/peluqueria.png" alt="Peluquería">
                  <hr>
                  <h5>Peluquería</h5>
                  <p>Baño, corte de pelo, limpieza de oídos, corte de uñas y peinados especiales para mascotas.</p>
                </div>
                <div class="card-item">
                  <img src="img/servicios/consultas.png" alt="Consultas">
                  <hr>
                  <h5>Consultas</h5>
                  <p>Revisión general, control de peso, vacunación, desparasitación y asesoramiento personalizado.</p>
                </div>
                <div class="card-item">
                  <img src="img/servicios/operaciones.png" alt="Operaciones">
                  <hr>
                  <h5>Cirugías</h5>
                  <p>Esterilización, extracción de tumores, limpieza dental, cuidados pre y postoperatorios.</p>
                </div>
                <div class="card-item">
                  <img src="img/servicios/examenes.png" alt="Exámenes">
                  <hr>
                  <h5>Laboratorio</h5>
                  <p>Análisis de sangre, orina, heces, pruebas hormonales y diagnósticos avanzados.</p>
                </div>
                <div class="card-item">
                  <img src="img/servicios/hospit-hd.png" alt="Hospital">
                  <hr>
                  <h5>Hospital</h5>
                  <p>Monitoreo constante, administración de medicamentos, cuidado postoperatorio y atención veterinaria especializada.</p>
                </div>
                <div class="card-item">
                  <img src="img/servicios/radiografia.png" alt="Radiografías">
                  <hr>
                  <h5>Radiografías</h5>
                  <p>Diagnóstico preciso, imágenes detalladas, evaluación de huesos, órganos y detección de lesiones.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
  <!-- end service section -->
<script>
  const carousel = document.querySelector('.carousel1');

carousel.addEventListener('mouseenter', () => {
  carousel.style.animationPlayState = 'paused'; // Detiene la animación al hacer hover
});

carousel.addEventListener('mouseleave', () => {
  carousel.style.animationPlayState = 'running'; // Reanuda la animación
});
</script>


  <!-- gallery section -->
  <section class="section reveal gallery-section layout_padding">
    <div class="container">
      <h2 class="custom_heading">
        Nuestra  <span>Galeria</span>
    </h2>
    </div>
    <div class="container ">
      <div class="img_box box-1" id="image-galeria">
        <img src="img/galeria/galeria1.png" alt="">
      </div>
      <div class="img_box box-2" id="image-galeria">
        <img src="img/galeria/galeria2.png" alt="">
      </div>
      <div class="img_box box-3" id="image-galeria">
        <img src="img/galeria/galeria3.png" alt="">
      </div>
      <div class="img_box box-4" id="image-galeria">
        <img src="img/galeria/galeria4.png" alt="">
      </div>
      <div class="img_box box-5" id="image-galeria">
        <img src="img/galeria/galeria5.png"alt="">
      </div>
      <div class="img_box box-6" id="image-galeria">
        <img src="img/galeria/galeria6.png" alt="">
      </div>
    </div>
  </section>



  <!-- end gallery section -->

  <!-- buy section -->
{{-- 
  <section class="buy_section layout_padding">
    <div class="container">
      <h2>
        You Can Buy Pet From Our Clinic
      </h2>
      <p>
        consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
        veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
      </p>
      <div class="d-flex justify-content-center">
        <a href="">
          Buy Now
        </a>
      </div>
    </div>
  </section> --}}

  <!-- end buy section -->

  <!-- client section -->
  <section class="section reveal client_section layout_padding-bottom">
    <div class="container">
      <h2 class="custom_heading text-center">
        Testimonios de Nuestros 
        <span>
          Clientes
        </span>
      </h2>
      <p class="text-center">
        Conoce las opiniones de nuestros clientes y descubre por qué confían en nosotros para brindarles una experiencia excepcional.
      </p>
      <div id="carouselExample2Indicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExample2Indicators" data-slide-to="0" class="active">🐾</li>
          <li data-target="#carouselExample2Indicators" data-slide-to="1">🐾</li>
          <li data-target="#carouselExample2Indicators" data-slide-to="2">🐾</li>
        </ol>
        <div class="carousel-inner">

            
          <div class="carousel-item active">
            <div class="layout_padding2 pl-100">
              <div class="client_container ">
                <div class="img_box" id="image-galeria">
                  <img src="img/clientes/cliente3.png" alt="">
                </div>
                <div class="detail_box">
                  <h5>
                    Sofía Paz Jxxx
                  </h5>
                  <p><i>
                    "Excelente atención, precios razonables y total preocupación por los animalitos ❤️"
                  </i>
                  </p>
                  
                  <p>
                    <strong><em>Comentario desde google</em></strong>
                  </p>
                </div>
              </div>
            </div>


          </div>
          


          <div class="carousel-item">
            <div class="layout_padding2 pl-100">
              <div class="client_container ">
                <div class="img_box" id="image-galeria">
                  
                  <img src="img/clientes/cliente1.png" alt="">
                </div>
                <div class="detail_box">
                  <h5>
                    Fernanda Pozo Axxxxxxxx
                  </h5>
                  <p><i>
                    "Excelente lugar para atender a las mascotas. Es accesible, cuenta con un pequeño estacionamiento. Los profesionales son muy amables y serviciales. Lamentablemente la sala de espera está en el exterior. Por lo demás es bastante recomendable."
                  </i>
                  </p>
                  <p>
                    <strong><em>Comentario desde google</em></strong>
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="carousel-item">
            <div class="layout_padding2 pl-100">
              <div class="client_container ">
                <div class="img_box" id="image-galeria">
                  <img src="img/clientes/cliente2.png" alt="">
                </div>
                <div class="detail_box">
                  <h5>
                    Fernando Pacheco
                  </h5>
                  <p><i>
                    "Excelente atención, muy profesionalas y cariñosos con nuestras mascotas, siempre indicando que realizarán o el estado en que se encuentra, además con precios accesibles, 100% recomendados"
                  </i>
                  </p>
                  <p>
                    <strong><em>Comentario desde google</em></strong>
                  </p>
                </div>
              </div>
            </div>


          </div>
        </div>

      </div>


    </div>

  </section>
  <!-- end client section -->

  <!-- map section -->

  <section class="section reveal map_section ">

    <div id="contenedor-super">

    <div class="contenedor-map">
      <div id="seccion-texto">
    <h2 class="custom_heading text-center">
      El Mejor Cuidado para tu Mascota 
      <span>
        te Espera Aquí
      </span>
    </h2>
    <p class="text-center">
      Contáctanos y visítanos para encontrar productos y servicios dedicados al bienestar de tu mascota. Nuestro equipo está listo para ayudarte a cuidarla como se merece.
    </p>
    <div class="form_container" id="contactanos">
      <div class="row">
        <div>
          <form action="">
            <h2 class="custom_heading text-center">
              <span>
                ¡Hablemos!
              </span>
            <div class="input">
              <input type="text" placeholder="Nombre" class="pt-3 input-boxes">
            </div>
            <div class="input">
              <input type=" text" class="input-boxes" placeholder="Celular">
            </div>
            <div class="input">
              <input type="email" class="input-boxes" placeholder="Email">
            </div>
            <div class="input">
              <input type="text" class="message-box  input-boxes" placeholder="Mensaje">
            </div>
            <div class="d-flex justify-content-center">
              <button>
                Enviar <i class="fa-solid fa-paw"></i>
              </button>
            </div>
          </form>
        </div>
        
      </div>
    </div>

  </div>

</div>

  
  <div class="contenedor-map">

    <div id="seccion-direccion">

    <div class="titular-map">


      <img src="img/fondo-contacto.png" alt="" width="500px">
   

    </div>

    
    <div id="map">

<iframe style="border-radius: 50px" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3319.8707100597217!2d-71.2146474!3d-33.6864118!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662559350f9d601%3A0xc1b21f9269af7284!2sHospital%20Veterinario%20San%20Agust%C3%ADn!5e0!3m2!1ses!2scl!4v1731312197965!5m2!1ses!2scl" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

    </div>

 

  </div>

</div>
</div>
<hr>

<div id="inferior">
<div id="ubicacion">
  <h5>NUESTRA DIRECCIÓN</h5>
  <p>  San Agustín 202 MELIPILLA</p>

  <p>  Email: veterinariasanagustin202@gmail.com</p>
<p>  Tel:  232073072</p>

  <p>  Celulares 997220946- 997667476</p>

  
</div>

<div>
  <h5>HORARIO DE ATENCIÓN</h5>
  <p>  LUNES - SÁBADOS</p>

<p>  10:00 AM - 18:50 PM</p>

  <p>  DOMINGOS </p>

  <p>  10:30 - 13:00</p>

  <p>  14:00 - 17:00 HRS</p>

  <p>  EMERGENCIAS (A LLAMADOS)</p>

</div>
</div>


  </section>

</div>
  <!-- end map section -->

  <!-- end info_section -->


  <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>

  <script>
    // This example adds a marker to indicate the position of Bondi Beach in Sydney,
    // Australia.
    // function initMap() {
    //   var map = new google.maps.Map(document.getElementById('map'), {
    //     zoom: 20,
    //     center: {
    //         lat:  -33.686454,
    //         lng: -71.209950
    //     },
    //   });

    //   var image = 'img/location-blue.png';
    //   var beachMarker = new google.maps.Marker({
    //     position: {
    //       lat:  -33.686454,
    //       lng: -71.209889
    //     },
  
    //     map: map,
    //     icon: image
    //   });
    // }
  </script>
  <!-- google map js -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDpTfOyF-p39bdw1vdsnYGO8ooLI03NtkY&callback=initMap">
  </script>
  <!-- end google map js -->


<script>

      // Selecciona todas las secciones con la clase "reveal"
const reveals = document.querySelectorAll('.reveal');

// Configura el Intersection Observer
const observer = new IntersectionObserver((entries, observer) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('active'); // Agrega la clase para animación
      observer.unobserve(entry.target); // Deja de observar una vez que está visible
    }
  });
}, { threshold: 0.1 }); // Activa cuando el 10% de la sección es visible

// Observa cada sección
reveals.forEach(reveal => {
  observer.observe(reveal);
});



</script>
</x-home>