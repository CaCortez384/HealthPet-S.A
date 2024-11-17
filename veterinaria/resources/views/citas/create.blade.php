<x-home>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <style>
        /* Contenedor principal del formulario */
        .form-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
            max-width: 700px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }

        .form-container h3 {
            font-size: 1.2em;
            color: #3c4043;
            margin-bottom: 8px;
        }

        .form-container label {
            font-size: 0.9em;
            color: #5f6368;
        }

        /* Inputs y select con un ancho limitado */
        .form-container input[type="text"],
        .form-container input[type="email"],
        .form-container input[type="tel"],
        .form-container select {
            width: 70%;
            padding: 10px;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            outline: none;
            font-size: 0.9em;
            transition: border-color 0.3s;
            margin-bottom: 10px;
        }

        /* Ajustes de foco */
        .form-container input:focus,
        .form-container select:focus {
            border-color: #4285f4;
        }

        .form-group label,
        .form-group input {
            display: block;
            margin: auto;
            text-align: center;
        }


        /* Estilo de los pasos */
        .step {
            display: none;
        }

        .step.active {
            display: block;
        }

        /* Calendario y selector de horas */
        .calendar-and-time {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }

        #calendar-container {
            width: 250px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .flatpickr-input {
            display: none;
            /* Oculta el input oculto */
        }


        .time-selector {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* Opciones de horario */
        .time-option {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            background-color: #fff;
        }

        .time-option.selected {
            background-color: #38a169;
            color: #fff;
        }

        /* Botones */
        .form-container button {
            padding: 10px;
            font-size: 0.9em;
            color: #ffffff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background-color: #1a73e8;
            transition: background-color 0.3s, box-shadow 0.3s;
            outline: none;
            margin-top: 10px;
        }

        .form-container button:hover {
            background-color: #1669c1;
            box-shadow: 0 4px 6px rgba(26, 115, 232, 0.3);
        }

        .form-container button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        /* Estilo del mensaje de éxito */
        #success-message {
            text-align: center;
            color: #34a853;
            font-weight: bold;
        }

        /* Adaptabilidad para dispositivos móviles */
        @media (max-width: 600px) {
            .calendar-and-time {
                flex-direction: column;
                align-items: center;
            }

            #calendar-container,
            .form-container input[type="text"],
            .form-container select {
                width: 100%;
            }
        }
    </style>

    <div class="form-container">
        <!-- Paso 1: Selección de servicio -->
        <div class="step active" id="step1">
            <h3>Elegir servicio</h3>
            <label for="service">Selecciona el servicio</label>
            <select id="service" name="service">
                <option value="consultation">Consulta</option>
                <option value="vaccination">Vacunación</option>
                <option value="checkup">Chequeo general</option>
            </select>
            <button type="button" onclick="nextStep()">Siguiente</button>
        </div>

        <!-- Paso 2: Selección de fecha y hora -->
        <div class="step" id="step2">
            <h3>Elegir hora y día</h3>
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
            <button type="button" onclick="prevStep()">Anterior</button>
            <button type="button" onclick="nextStep()">Siguiente</button>
        </div>

        <!-- Paso 3: Llenar datos -->
        <div class="step" id="step3">
            <h3>Llenar datos</h3>
            <label for="name">Nombre completo</label>
            <input type="text" id="name" name="name" required>
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" required>
            <label for="phone">Teléfono</label>
            <input type="tel" id="phone" name="phone" required>
            <button type="button" onclick="prevStep()">Anterior</button>
            <button type="button" onclick="nextStep()">Siguiente</button>
        </div>

        <!-- Paso 4: Confirmación -->
        <div class="step" id="step4">
            <h3>Confirmación</h3>
            <p>Revisa y confirma los datos de tu cita.</p>
            <button type="button" onclick="prevStep()">Anterior</button>
            <button type="submit" onclick="showSuccess()">Confirmar cita</button>
        </div>

        <!-- Mensaje de éxito -->
        <div id="success-message" style="display: none;">
            <p>¡Cita agendada con éxito!</p>
        </div>
    </div>

    <script>
        let currentStep = 1;

        function showStep(step) {
            document.querySelectorAll('.step').forEach((el, index) => {
                el.classList.toggle('active', index === step - 1);
            });
        }

        function nextStep() {
            if (currentStep < 4) {
                currentStep++;
                showStep(currentStep);
            }
        }

        function prevStep() {
            if (currentStep > 1) {
                currentStep--;
                showStep(currentStep);
            }
        }

        function showSuccess() {
            document.getElementById('success-message').style.display = 'block';
            document.querySelector('.form-container').style.display = 'none';
        }

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
</x-home>
