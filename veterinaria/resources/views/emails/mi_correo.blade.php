<!DOCTYPE html>
<html>
<head>
    <title>Correo de Prueba</title>
</head>
<body>
    <h1>Hola, {{ $data['nombre'] }}</h1>
    <p>Este es un correo de prueba usando Mailtrap.</p>
    <p>Mensaje: {{ $data['mensaje'] }}</p>
    <p>Mensaje: {{ $data['pedido_id'] }}</p>
    <p>Mensaje: {{ $data['monto_pagado'] }}</p>

</body>
</html>
