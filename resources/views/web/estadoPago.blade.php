<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado del Pago</title>

    <!-- Material Design 3 Styles -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@material/web-components@0.0.21/dist/mdc.min.css">
    <link href="{{ asset('css/home/estadoPago.css') }}" rel="stylesheet">

</head>

<body>

    <div id="wrapper">
        <!-- Reciept top-half -->
        
        <div class="card">
            <div class="icon"></div>
            <h1>
                ¡Pago Aprobado!
            </h1>
            <p>
                Tu transacción ha sido procesada con éxito. ¡Gracias por tu compra!
            </p>
        </div>

        <!-- Reciept bottom-half -->
        <div class="card">
            <ul>
                <li>
                    <span>Orden de compra</span>
                    <span>{{ $response->getBuyOrder() }}</span>
                </li>
                <li>
                    <span>Código de autorización</span>
                    <span>{{ $response->getAuthorizationCode() }}</span>
                </li>
                <li>
                    <span>Monto</span>
                    <span>{{ $response->getAmount() }} CLP</span>
                </li>
                <li>
                    <span>Fecha de pago</span>
                    <span>{{ \Carbon\Carbon::createFromFormat('dm', $response->getAccountingDate())->format('d-m-Y') }}</span>
                </li>
            </ul>
        </div>

        <!-- Reciept CTA -->
        <div class="card">
            <div class="cta-row">
                <button class="secondary" onclick="window.location.href='{{ route('petshop') }}'">
                    Volver a la tienda
                </button>

            </div>
        </div>
    </div>

</body>

</html>
