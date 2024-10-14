<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Detalle del venta</title>
        <style>
            p {
                font-size: 14px;
            }

            #titulo {
                width: 100%;
                background-color: rgb(41, 41, 41);
            }

            #titulo > h3 {
                margin-left: 260px;
                letter-spacing: 20px;
                color: white;
            }
            .subtitulo {
    text-align: center; /* En lugar de usar flex */
    margin: 20px 0;
}

.subtitulo h5, .subtitulo h1 {
    display: inline-block; /* Asegura que estén en línea */
    margin: 0 130px; /* Espacio entre elementos */
}
        </style>
    </head>
<body>


        <div id="titulo">
            <h3>RECIBO</h3>
        </div>

        <div class="subtitulo">
            <h5>Consumidor Final</h5>
            <img src="{{ asset('public\img\logo-vet.png') }}" alt="Logo">
        </div>


        <div class="bottom-container">
            <h4>Detalle del Producto</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>Venta#</th>
                        <th>Fecha</th>
                        <th>Forma de pago</th>
                        <th>Asistido por</th>
                    </tr>
                </thead>
                <tbody>
               
                        <tr>
                            <td>{{ $venta->id }}</td>
                            <td>{{ $venta->fecha_venta }}</td>
                            <td><p>agergar esto despues</p></td>
                            <td>{{ $venta->nombre_cliente ?? 'No especificado'  }}</td>
                        </tr>
          
                </tbody>
            </table>
        </div>


    <h1>Detalle del Producto</h1>
    <p><strong>Nombre:</strong> {{ $venta->nombre_cliente ?? 'No especificado'  }}</p>
    <p><strong>Precio:</strong>{{ $venta->nombre_cliente ?? 'No especificado'  }}</p>
    <p><strong>Descripción:</strong> {{ $venta->rut_cliente ?? 'No especificado' }}</p>


    <div class="bottom-container">
        <h4>Productos en la venta</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalle as $detalle)
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }}</td>
                        <td>{{ number_format($detalle->precio_unitario, 0, ',', '.') }} CLP</td>
                        <td>{{ number_format($detalle->precio_unitario * $detalle->cantidad, 0, ',', '.') }} CLP</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>