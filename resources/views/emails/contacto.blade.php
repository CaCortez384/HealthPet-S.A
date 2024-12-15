
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veterinaria</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header */
        header {
            background-color: #00bcd4; /* Celeste tipo médico */
            color: white;
            text-align: center;
            padding: 20px;
            position: relative;
        }

        header img {
            max-width: 150px;
            height: auto;
        }

        /* Main Content */
        main {
            flex: 1;
            padding: 20px;
            background-color: #ffffff;
        }

        /* Footer */
        footer {
            background-color: #f5f5f5; /* Gris claro */
            color: #666;
            text-align: center;
            padding: 20px;
        }

        footer .icons {
            margin-top: 10px;
        }

        footer .icons i {
            margin: 0 10px;
            font-size: 20px;
            color: #00bcd4;
        }

        footer .rights {
            margin-top: 20px;
            font-size: 14px;
            color: #888;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header img {
                max-width: 100px;
            }

            footer .icons i {
                font-size: 16px;
                margin: 0 5px;
            }
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfgcMSHvp--nvLRwJV6JC5HD1JkwosG7w9ig&s" alt="Logo de la Veterinaria" style="border-radius:50% ">
    </header>

    <!-- Main Content -->
    <!-- Footer -->
    <footer>
        <div class="icons">
            <h1>Nuevo mensaje de contacto</h1>
            
            <i class="fa-solid fa-user"></i> <p><strong>Nombre:</strong> {{ $nombre }}</p>
            <hr>
            <i class="fas fa-phone"></i><p><strong>Celular:</strong> {{ $celular }}</p>
            <hr>
            <i class="fa-regular fa-envelope"></i> <p><strong>Correo:</strong> {{ $correo }}</p>
            <hr>
            <i class="fa-regular fa-comments"></i> <p style="width: 95%; margin: auto"><strong>Mensaje:</strong> {{ $mensaje }}</p>
            <hr>
        </div>



        <div class="rights">
            © 2024 Hospital Veterinario San Agustin. Todos los derechos reservados. <br>
            Desarrollado por Alchemy Software.
        </div>
    </footer>

</body>
</html>
