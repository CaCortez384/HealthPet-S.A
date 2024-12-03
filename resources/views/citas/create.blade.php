<x-home>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link href="{{ asset('css/home/citas.css') }}" rel="stylesheet">
    <div class="wrap">

        <div class="form-wizard">
            <div class="steps">
                <ul>
                    <li>
                        <span>1</span>
                        Seleccionar servicio
                    </li>
                    <li>
                        <span>2</span>
                        Fecha y hora
                    </li>
                    <li>
                        <span>3</span>
                        Llenar Datos
                    </li>
                    <li>
                        <span>4</span>
                        Fin
                    </li>
                </ul>
            </div>
            <div class="myContainer">
                <div class="form-container animated">
                    <h2 class="text-center form-title">Seleccionar servicio</h2>
                    <form>
                        <div class="form-group">
                            <select id="service" name="service">
                                <option value="consultation">Consulta</option>
                                <option value="vaccination">Vacunación</option>
                                <option value="checkup">Chequeo general</option>
                            </select>
                        </div>
                        <div class="form-group text-center mar-b-0">
                            <input type="button" value="NEXT" class="btn btn-primary next">
                        </div>
                    </form>
                    <div></div>
                </div>

                <div class="form-container animated">
                    <h2 class="text-center form-title">Seleccionar fecha y horario</h2>
                    <form>
                        <div class="form-group">
                            <div class="calendar-and-time">
                                <!-- Calendario Inline -->
                                <div id="calendar-container"></div>

                                <!-- Selector de horas -->
                                <div class="time-selector">
                                    <button type="button" class="time-option">10:00 am</button>
                                    <button type="button" class="time-option">11:00 am</button>
                                    <button type="button" class="time-option">12:00 pm</button>
                                    <button type="button" class="time-option">01:00 pm</button>
                                    <button type="button" class="time-option">02:00 pm</button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center mar-b-0">
                            <input type="button" value="BACK" class="btn btn-default back">
                            <input type="button" value="NEXT" class="btn btn-primary next">
                        </div>
                    </form>
                </div>


                <div class="form-container animated">
                    <h2 class="text-center form-title">Datos de tutor y mascota</h2>
                    <form>
                        <div class="form-group">
                            <input type="text" placeholder="Nombre del tutor">
                        </div>
                        <div class="form-group">
                <input type="text"
                    placeholder="Correo">
                </div>
                  <div class="form-group">
                            <input type="text" placeholder="Nro de contacto">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Nombre de mascota">
                        </div>
                        <div class="form-group">
                            <input type="text" placeholder="Raza">
                        </div>
                        <div class="form-group">
                            <textarea placeholder="Cuentanos, ¿Porque solicitas el servicio?"></textarea>
                        </div>
                        <div class="form-group text-center mar-b-0">
                            <input type="button" value="BACK" class="btn btn-default back">
                            <input type="button" value="NEXT" class="btn btn-primary next">
                        </div>
                    </form>
                </div>
                <div class="form-container animated">
                    <h2 class="text-center form-title">Estas a un click de confirmar!</h2>
                    <form>
                        <div class="form-group">
                            <h3 class="text-center">Verifique la informacion antes de Finalizar</h3>
                            <p class="text-center">La informacion de la cita sera enviada a su correo</p>
                            <p class="text-center">Gracias por preferirnos!</p>
                        </div>
                        <div class="form-group text-center mar-b-0">
                            <input type="button" value="Atras" class="btn btn-default back">
                            <input type="submit" value="Finalizar" class="btn btn-primary submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#calendar-container", {
                inline: true,
                dateFormat: "d-m-Y",
                defaultDate: "today",
                locale: "es"
            });

            const timeOptions = document.querySelectorAll('.time-option');
            timeOptions.forEach(option => {
                option.addEventListener('click', function() {
                    timeOptions.forEach(opt => opt.classList.remove('selected'));
                    option.classList.add('selected');
                });
            });
        });
    </script>

    <script>
        var totalSteps = $(".steps li").length;

        $(".submit").on("click", function() {
            return false;
        });

        $(".steps li:nth-of-type(1)").addClass("active");
        $(".myContainer .form-container:nth-of-type(1)").addClass("active");

        $(".form-container").on("click", ".next", function() {
            $(".steps li").eq($(this).parents(".form-container").index() + 1).addClass("active");
            $(this).parents(".form-container").removeClass("active").next().addClass("active flipInX");
        });

        $(".form-container").on("click", ".back", function() {
            $(".steps li").eq($(this).parents(".form-container").index() - totalSteps).removeClass("active");
            $(this).parents(".form-container").removeClass("active flipInX").prev().addClass("active flipInY");
        });


        /*=========================================================
        *     If you won't to make steps clickable, Please comment below code 
        =================================================================*/
        $(".steps li").on("click", function() {
            var stepVal = $(this).find("span").text();
            $(this).prevAll().addClass("active");
            $(this).addClass("active");
            $(this).nextAll().removeClass("active");
            $(".myContainer .form-container").removeClass("active flipInX");
            $(".myContainer .form-container:nth-of-type(" + stepVal + ")").addClass("active flipInX");
        });
    </script>
</x-home>
