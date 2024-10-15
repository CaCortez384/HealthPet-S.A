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

.table1 {
        width: 50%;
        border-collapse: collapse;
    }

    .table1>thead>tr>th {
        background-color: rgb(150, 149, 149);
        color: rgb(3, 3, 3);
        padding: 10px;
        text-align: left;
        border: 1px solid #000;
    }

    .table1>thead>tr>td {
        padding: 10px;
        border: 1px solid #000;
    }

    
.table {
        width: 100%;
        border-collapse: collapse;
    }

    .table>thead>tr>th {
        background-color: rgb(150, 149, 149);
        color: rgb(3, 3, 3);
        padding: 10px;
        text-align: left;
        border: 1px solid #000;
    }

    .table>tbody>tr>td {
        padding: 10px;
        border: 1px solid #000;
    }

    #final{
        border-bottom: solid black 2px;
        border-top: solid black 2px;
        text-align: center; 
        
    }
        </style>
    </head>
<body>

    @php
    // Inicializar una variable para el total de unidades vendidas
    $totalUnidadesVendidas = 0;
@endphp


        <div id="titulo">
            <h3>RECIBO</h3>
        </div>

        <div class="subtitulo">
            <h5>Consumidor Final</h5>

        </div>


        <div class="bottom-container">

            <table class="table1">
                <thead>
                    <tr>
                        <th>Venta#</th>
                        <td>00{{ $venta->id }}</td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <td>{{ $venta->fecha_venta }}</td>

                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>Forma de pago</th>
                        {{-- agregar este parametro en la venta --}}
                        <td>Efectivo</td>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>Asistido por</th>
                        {{-- agregar este parametro en la venta --}}
                        <td>{{ $venta->nombre_vendedor ?? 'No especificado'  }}</td>
                    </tr>
                </thead>

            </table>
        </div>



    <div class="bottom-container">
<br>
        <table class="table">
            <thead>
                <tr>
                    <th>Productos / Servicios</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detalle as $detalle)

                @php
                // Sumar las cantidades para obtener el total de unidades vendidas
                $totalUnidadesVendidas += $detalle->cantidad;
            @endphp
                    <tr>
                        <td>{{ $detalle->producto->nombre }}</td>
                        <td>{{ $detalle->cantidad }} {{ $detalle->tipo_venta }}</td>
                        <td>${{ number_format($detalle->precio_unitario, 0, ',', '.') }} CLP</td>
                        <td>${{ number_format($detalle->precio_unitario * $detalle->cantidad, 0, ',', '.') }} CLP</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

<br>


            <div class="bottom-container">

                <table class="table1">
                    <thead>
                        <tr>
                            <th>Numero de items</th>
                            <td>{{$totalUnidadesVendidas}} </td>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th><strong>Total</strong></th>
                            <td><strong>{{ $venta->total  }}</strong></td>
    
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>Descuento Aplicado({{ $venta->descuento }}%)</th>
                            <td>
                                ${{ number_format(

                                    $venta->subtotal - 
                                    
                                    floatval(preg_replace('/[^\d]/', '', $venta->total)),
                                    0, // Número de decimales
    ',', // Separador de decimales
    '.' // Separador de miles
                       
                                ) }} CLP
                            </td>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <td></td>
                            {{-- agregar este parametro en la venta --}}
                            <td> @switch($venta->estado_pago)
                                @case(0)
                                    Registra deuda
                                    @break
                                @case(1)
                                    Completa
                                    @break
                                @case(2)
                                    Anulada
                                    @break
                                @default
                                    Desconocido
                            @endswitch</td>
                        </tr>
                    </thead>
    
                </table>
            </div>


            <br>

        <div id="final">
            <h3>DOCUMENTO NO VÁLIDO COMO FACTURA</h3>
        </div>


</body>
</html>