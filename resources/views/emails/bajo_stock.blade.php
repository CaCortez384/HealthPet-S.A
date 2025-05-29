<!DOCTYPE html>
<html>
<head>
    <title>Notificación de Bajo Stock</title>
</head>
<body>
    <h1>Productos con Bajo Stock</h1>
    <ul>
        @foreach ($productos as $producto)
            <li>{{ $producto->nombre }} - Stock Actual: {{ $producto->stock }}</li>
        @endforeach
    </ul>
</body>
</html>
