<style>
    @import url("https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700");

    @-webkit-keyframes scaleIn {
        from {
            transform: scale(0.5, 0.5);
            opacity: 0.2;
        }

        to {
            transform: scale(2, 2);
            opacity: 0;
        }
    }

    @keyframes scaleIn {
        from {
            transform: scale(0.5, 0.5);
            opacity: 0.2;
        }

        to {
            transform: scale(2, 2);
            opacity: 0;
        }
    }

    * {
        box-sizing: border-box;
    }

    a {
        text-decoration: none;
        color: inherit;
    }

    h1,
    h2,
    h3 {
        margin: 0;
        padding: 0;
    }

    .card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 2px 2px 10px 0 rgba(0, 0, 0, 0.2);
        display: flex;
        justify-content: space-between;
        flex-direction: column;
        height: 300px;
        padding: 40px;
        width: 650px;
    }

    .card__details {
        display: flex;
        justify-content: space-between;
    }

    .h1 {
        font-size: 18px;
    }

    .h2 {
        font-size: 18px;
    }

    .card-details__heading {
        font-weight: 500;
        text-align: start;
    }

    .card-details__order-number {
        color: #f77f00;
        font-weight: bold;
        text-transform: uppercase;
    }

    .shipping-details {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
    }

    .shipping-details__heading {
        font-weight: 500;
    }

    .progress-bar {
        align-content: center;
        justify-content: space-between;
        display: grid;
        grid-template-columns: 125px 125px 165px auto;
        background: linear-gradient(to right, #c0d9e4 0%, #c0d9e4 60%, #c0d9e4 60%, #c0d9e4 100%);
        height: 20px;
        border-radius: 10px;
    }

    .progress-bar__step {
        align-items: center;
        background-image: url(https://assets.codepen.io/4152061/icons8-circle-60.png);
        background-color: #c0d9e4;
        background-position: center center;
        background-size: 20px;
        background-repeat: no-repeat;
        display: flex;
        justify-content: center;
        width: 35px;
        height: 35px;
        border-radius: 50%;
    }

    .icon {
        display: flex;
        align-self: end;
    }

    .icon__svg {
        height: 50px;
    }

    .icon__svg--en-route {
        height: 60px;
    }

    .icon__label {
        align-self: center;
        font-size: 12px;
        margin-left: 10px;
    }

    .is-active {
        background-size: 20px;
        background-repeat: no-repeat;
        background-position: center center;
        background-image: url(https://assets.codepen.io/4152061/checkmark.png);
        background-color: #f77f00;
    }

    .is-animated {
        -webkit-animation: scaleIn 3s infinite cubic-bezier(0.36, 0.11, 0.89, 0.32);
        animation: scaleIn 3s infinite cubic-bezier(0.36, 0.11, 0.89, 0.32);
        background-color: #f77f00;
        position: absolute;
        width: 45px;
        height: 45px;
        border-radius: 50%;
    }

    .card__icons {
        display: flex;
        justify-content: space-between;
    }

    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f8f9fa;
        color: #333;
        line-height: 1.6;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .email-container {
        max-width: 650px;
        margin: 20px auto;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    .header {
        background-color: #f77f00;
        color: #ffffff;
        text-align: center;
        padding: 20px;
    }

    .header img {
        max-width: 80px;
        border-radius: 50%;
        margin-bottom: 10px;
    }

    .header h1 {
        margin: 0;
        font-size: 24px;
        font-weight: bold;
    }

    .content {
        padding: 20px;
    }

    .content h2 {
        font-size: 20px;
        color: #f77f00;
    }

    .content p {
        margin: 5px 0;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }

    .table th,
    .table td {
        text-align: left;
        padding: 10px;
        border: 1px solid #ddd;
    }

    .table th {
        background-color: #f77f00;
        color: #ffffff;
    }

    .footer {
        text-align: center;
        background-color: #f8f9fa;
        padding: 20px;
        font-size: 14px;
        color: #666;
    }

    .footer a {
        color: #f77f00;
        text-decoration: none;
    }

    @media (max-width: 600px) {
        .email-container {
            width: 100%;
            border-radius: 0;
            box-shadow: none;
        }

        .content,
        .footer {
            padding: 15px;
        }
    }
</style>

<body>

    <div class="seguimiento">
        <div class="card" role="dialog">
            
            <div class="card__details">
                <h1 class="h1 order-details__heading">PEDIDO <a href="#"
                        class="card-details__order-number">{{ $data['pedido_id'] }}</a>
                </h1>
            </div>

            @php
                $estado_pedido = $data['estado_pedido'];
            @endphp

            <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuetext="Step {{ $estado_pedido }}.">
                <div class="progress-bar__step {{ $estado_pedido >= 1 ? 'is-active' : '' }}" id="js-order-processed"></div>
                <div class="progress-bar__step {{ $estado_pedido >= 2 ? 'is-active' : '' }}" id="js-order-shipped"></div>
                <div class="progress-bar__step {{ $estado_pedido >= 2 ? 'is-active' : '' }}" id="js-order-en-route"></div>
                <div class="progress-bar__step {{ $estado_pedido >= 3 ? 'is-active' : '' }}" id="js-order-arrived"></div>
            </div>

            <div class="card__icons">
                <div class="icon">
                    <svg class="icon__svg" xmlns="http://www.w3.org/2000/svg" viewBox="40 0 450 512">
                        <path
                            d="M400.292 32.064h-48.613v-5.276c0-12.572-18.105-17.987-31.724-20.966C302.789 2.068 280.076 0 256 0s-46.789 2.068-63.954 5.823c-13.619 2.979-31.724 8.394-31.724 20.966v5.276h-48.613c-21.816 0-39.564 17.749-39.564 39.565v400.806c0 21.816 17.749 39.564 39.564 39.564H400.29c21.816 0 39.564-17.749 39.564-39.564V71.629c.002-21.816-17.747-39.565-39.562-39.565zm-224.968-4.313C179.771 23.209 207.419 15 256 15c48.582 0 76.229 8.209 80.677 12.751v35.862a.516.516 0 01-.516.516H175.839a.517.517 0 01-.516-.516V27.751zM400.292 497H111.709c-13.545 0-24.564-11.02-24.564-24.564V71.629c0-13.545 11.02-24.565 24.564-24.565h48.613v16.548c0 8.556 6.96 15.516 15.516 15.516H336.16c8.556 0 15.516-6.961 15.516-15.516V47.064h48.613c13.545 0 24.564 11.02 24.564 24.565v400.807h.002c.001 13.545-11.019 24.564-24.563 24.564z" />
                        <path
                            d="M392.274 64.129h-16.033a7.5 7.5 0 000 15h16.033c.285 0 .516.231.516.516v352.709a.516.516 0 01-.516.516H119.727a.516.516 0 01-.516-.516V79.645c0-.285.231-.516.516-.516h16.033a7.5 7.5 0 000-15h-16.033c-8.556 0-15.516 6.96-15.516 15.516v352.709c0 8.556 6.96 15.516 15.516 15.516h272.549c8.556 0 15.516-6.96 15.516-15.516V79.645c0-8.555-6.961-15.516-15.518-15.516z" />
                        <path fill="#1d7eef"
                            d="M183.855 128.259c-12.975 0-23.532 10.557-23.532 23.532s10.556 23.532 23.532 23.532 23.532-10.557 23.532-23.532c.001-12.975-10.556-23.532-23.532-23.532zm0 32.063c-4.704 0-8.532-3.828-8.532-8.532s3.827-8.532 8.532-8.532 8.532 3.828 8.532 8.532-3.827 8.532-8.532 8.532zM344.178 128.258H231.953a7.5 7.5 0 000 15h112.226a7.5 7.5 0 10-.001-15zM239.969 160.323h-8.016a7.5 7.5 0 000 15h8.016a7.5 7.5 0 000-15zM304.096 160.323h-32.064a7.5 7.5 0 000 15h32.064a7.5 7.5 0 000-15zM183.855 200.404c-12.975 0-23.532 10.557-23.532 23.532s10.556 23.532 23.532 23.532 23.532-10.557 23.532-23.532c.001-12.975-10.556-23.532-23.532-23.532zm0 32.063c-4.704 0-8.532-3.828-8.532-8.532s3.827-8.532 8.532-8.532 8.532 3.828 8.532 8.532-3.827 8.532-8.532 8.532zM344.178 200.403H231.953a7.5 7.5 0 000 15h112.226a7.5 7.5 0 10-.001-15zM239.969 232.468h-8.016a7.5 7.5 0 000 15h8.016a7.5 7.5 0 000-15zM304.096 232.468h-32.064a7.5 7.5 0 000 15h32.064a7.5 7.5 0 000-15zM183.855 272.549c-12.975 0-23.532 10.557-23.532 23.532s10.556 23.532 23.532 23.532 23.532-10.557 23.532-23.532c.001-12.975-10.556-23.532-23.532-23.532zm0 32.063c-4.704 0-8.532-3.828-8.532-8.532 0-4.704 3.827-8.532 8.532-8.532s8.532 3.828 8.532 8.532c.001 4.704-3.827 8.532-8.532 8.532zM344.178 272.548H231.953a7.5 7.5 0 000 15h112.226a7.5 7.5 0 10-.001-15zM239.969 304.613h-8.016a7.5 7.5 0 000 15h8.016a7.5 7.5 0 000-15zM304.096 304.613h-32.064a7.5 7.5 0 000 15h32.064a7.5 7.5 0 000-15zM183.855 344.694c-12.975 0-23.532 10.557-23.532 23.532s10.556 23.532 23.532 23.532 23.532-10.557 23.532-23.532c.001-12.975-10.556-23.532-23.532-23.532zm0 32.064c-4.704 0-8.532-3.828-8.532-8.532 0-4.704 3.827-8.532 8.532-8.532s8.532 3.828 8.532 8.532c.001 4.704-3.827 8.532-8.532 8.532zM344.178 344.694H231.953a7.5 7.5 0 000 15h112.226a7.5 7.5 0 10-.001-15zM239.969 376.758h-8.016a7.5 7.5 0 000 15h8.016a7.5 7.5 0 000-15zM304.096 376.758h-32.064a7.5 7.5 0 000 15h32.064a7.5 7.5 0 000-15zM256.041 32.064h-.08c-4.142 0-7.46 3.358-7.46 7.5 0 4.142 3.398 7.5 7.54 7.5a7.5 7.5 0 000-15z" />
                        </>
                        <span class="icon__label">Pedido <br>Procesado</span>
                </div>
                <div class="icon">
                    <svg class="icon__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M491.729 112.971L259.261.745a7.503 7.503 0 00-6.521 0L20.271 112.971a7.5 7.5 0 00-4.239 6.754v272.549a7.5 7.5 0 004.239 6.754l232.468 112.226a7.504 7.504 0 006.522 0l232.468-112.226a7.5 7.5 0 004.239-6.754V119.726a7.502 7.502 0 00-4.239-6.755zM256 15.828l215.217 103.897-62.387 30.118a7.434 7.434 0 00-1.27-.8L193.805 45.853 256 15.828zm-79.133 38.505l214.904 103.746-44.015 21.249L132.941 75.624l43.926-21.291zm219.932 117.974v78.546l-41.113 19.848v-78.546l41.113-19.848zm84.169 215.261L263.5 492.55V236.658l51.873-25.042a7.5 7.5 0 10-6.522-13.508L256 223.623l-20.796-10.04a7.498 7.498 0 00-10.015 3.493 7.5 7.5 0 003.493 10.015l19.818 9.567V492.55L31.032 387.566V131.674l165.6 79.945a7.463 7.463 0 003.255.748 7.5 7.5 0 003.266-14.256l-162.37-78.386 74.505-35.968L340.582 192.52c.033.046.07.087.104.132v89.999a7.502 7.502 0 0010.761 6.754l56.113-27.089a7.499 7.499 0 004.239-6.754v-90.495l69.169-33.392v255.893z" />
                        <path fill="#1d7eef"
                            d="M92.926 358.479L58.811 342.01a7.5 7.5 0 00-6.522 13.508l34.115 16.469a7.463 7.463 0 003.255.748 7.5 7.5 0 006.759-4.241 7.499 7.499 0 00-3.492-10.015zM124.323 338.042l-65.465-31.604a7.501 7.501 0 00-6.521 13.509l65.465 31.604a7.477 7.477 0 003.255.748 7.5 7.5 0 003.266-14.257z" />
                    </svg>
                    <span class="icon__label">Pedido <br>Enviado</span>
                </div>
                <div class="icon">
                    <svg class="icon__svg icon__svg--en-route" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M111.709 344.693c-8.556 0-15.516 6.96-15.516 15.516 0 8.556 6.96 15.516 15.516 15.516 8.556 0 15.516-6.96 15.516-15.516 0-8.556-6.96-15.516-15.516-15.516zM432.355 344.693c-8.556 0-15.516 6.96-15.516 15.516 0 8.556 6.96 15.516 15.516 15.516 8.556 0 15.516-6.96 15.516-15.516 0-8.556-6.96-15.516-15.516-15.516z" />
                        <path
                            d="M495.909 245.23l-57.744-19.248-26.989-74.218c-3.369-9.265-12.256-15.49-22.115-15.49h-69.448v-16.549c0-8.556-6.96-15.516-15.516-15.516H15.516C6.96 104.209 0 111.17 0 119.726v216.436c0 8.556 6.96 15.516 15.516 15.516H64.91a47.61 47.61 0 00-.781 8.532c0 26.236 21.345 47.581 47.581 47.581s47.581-21.345 47.581-47.581c0-2.914-.277-5.762-.781-8.532h227.047a47.61 47.61 0 00-.781 8.532c0 26.236 21.345 47.581 47.581 47.581 26.236 0 47.581-21.345 47.581-47.581 0-3.706-.44-7.31-1.245-10.774l15.871-7.935C505.318 336.122 512 325.309 512 313.282v-45.727a23.504 23.504 0 00-16.091-22.325zM15 119.726c0-.285.231-.517.516-.517h288.581c.285 0 .516.231.516.516v160.839H15V119.726zm96.709 273.065c-17.965 0-32.581-14.616-32.581-32.581 0-17.965 14.616-32.581 32.581-32.581 17.965 0 32.581 14.616 32.581 32.581.001 17.965-14.615 32.581-32.581 32.581zm192.904-56.114H153.038c-8.203-14.349-23.65-24.048-41.329-24.048-17.679 0-33.125 9.699-41.328 24.048H15.516a.516.516 0 01-.516-.516v-40.597h289.613v41.113zm102.085-153.338l14.95 41.113h-16.104l-14.95-41.113h16.104zm-87.085-32.065h69.448a8.559 8.559 0 018.019 5.616l4.163 11.448h-81.63v-17.064zm0 32.065h55.02l14.95 41.113h-69.97v-41.113zm112.742 209.452c-17.965 0-32.581-14.616-32.581-32.581 0-17.965 14.616-32.581 32.581-32.581 17.965 0 32.581 14.616 32.581 32.581 0 17.965-14.616 32.581-32.581 32.581zM497 280.563h-8.532a7.5 7.5 0 000 15H497v17.718c0 6.31-3.505 11.981-9.147 14.803l-14.847 7.423c-8.36-13.707-23.454-22.878-40.651-22.878-17.679 0-33.125 9.699-41.328 24.048h-71.414v-41.113h136.791a7.5 7.5 0 000-15H319.613v-41.113h111.525l60.028 20.009a8.52 8.52 0 015.834 8.094v13.009z" />
                        <path fill="#1d7eef"
                            d="M251.705 193.375l-56.113-32.064a7.501 7.501 0 00-7.442 13.024l31.592 18.053H71.629a7.5 7.5 0 000 14.999h148.113L188.15 225.44a7.5 7.5 0 007.442 13.023l56.113-32.064a7.5 7.5 0 000-13.024z" />
                    </svg>
                    <span class="icon__label">Pedido <br>En transito</span>
                </div>
                <div class="icon">
                    <svg class="icon__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <path
                            d="M488.468 448.903h-8.532V226.4C499.202 214.003 512 192.386 512 167.822a7.505 7.505 0 00-.988-3.721L451.499 59.953a23.587 23.587 0 00-20.432-11.857H80.933a23.585 23.585 0 00-20.432 11.857L.988 164.101A7.508 7.508 0 000 167.822c0 24.564 12.798 46.181 32.064 58.578v222.503h-8.532a7.5 7.5 0 000 15h464.936a7.5 7.5 0 000-15zM15.517 175.322h24.044a7.5 7.5 0 000-15H20.424l53.101-92.927a8.551 8.551 0 017.408-4.299h350.134a8.55 8.55 0 017.408 4.299l53.1 92.927h-19.141a7.5 7.5 0 00-7.5 7.5 7.5 7.5 0 007.5 7.5h24.048c-3.667 26.584-26.532 47.125-54.108 47.125-27.575 0-50.429-20.543-54.097-47.125h52.096a7.5 7.5 0 007.5-7.5 7.5 7.5 0 00-7.5-7.5H71.631a7.5 7.5 0 000 15h52.091c-3.668 26.582-26.523 47.125-54.097 47.125-27.576 0-50.441-20.541-54.108-47.125zm356.705 0c-3.668 26.582-26.523 47.125-54.097 47.125-27.575 0-50.429-20.543-54.097-47.125h108.194zm-124.25 0c-3.668 26.582-26.523 47.125-54.097 47.125s-50.429-20.543-54.097-47.125h108.194zm176.882 273.582h-81.193v-25.081h81.193v25.081zm0-40.081h-81.193V271.516h81.193v137.307zm40.082 40.081h-25.081V264.016a7.5 7.5 0 00-7.5-7.5h-96.193a7.5 7.5 0 00-7.5 7.5v184.887H47.064V233.674a69.289 69.289 0 0022.561 3.773c27.095 0 50.624-15.556 62.125-38.207 11.501 22.65 35.03 38.207 62.125 38.207S244.499 221.891 256 199.24c11.501 22.65 35.03 38.207 62.125 38.207s50.624-15.556 62.125-38.207c11.501 22.65 35.03 38.207 62.125 38.207 7.896 0 15.48-1.34 22.561-3.772v215.229z" />
                        <path fill="#1d7eef"
                            d="M296.081 256.516H79.645a7.5 7.5 0 00-7.5 7.5v152.307a7.5 7.5 0 007.5 7.5h216.436a7.5 7.5 0 007.5-7.5V264.016c0-4.143-3.357-7.5-7.5-7.5zm-7.5 152.307H87.145V271.516h201.436v137.307z" />
                    </svg>
                    <span class="icon__label">Pedido <br>Listo para retiro</span>
                </div>
            </div>
        </div>
    </div>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTfgcMSHvp--nvLRwJV6JC5HD1JkwosG7w9ig&s"
                alt="Logo de la Veterinaria">
            <h1>Hospital Veterinario San Agustín</h1>
            <p>Gracias por confiar en nosotros para el cuidado de tu mascota</p>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>¡Hola, {{ $data['nombre'] }}!</h2>
            <p>Gracias por tu compra en nuestro Hospital Veterinario. Aquí tienes los detalles de tu pedido:</p>

            <p><strong>ID del Pedido:</strong> {{ $data['pedido_id'] }}</p>
            <p><strong>Monto Pagado:</strong> ${{ number_format($data['monto_pagado'], 0, ',', '.') }}</p>
            <p><strong>Pago Restante:</strong> ${{ number_format($data['pago_restante'], 0, ',', '.') }}</p>

            <h3>Productos</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['productos'] as $producto)
                        <tr>
                            <td>{{ $producto['nombre'] }}</td>
                            <td>{{ $producto['cantidad'] }}</td>
                            <td>$ {{ $producto['precio'] }}</td>
                            <td>$ {{ number_format($producto['subtotal'], 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p>Se enviara un correo en cuanto sus productos esten listos para retiro</p>

            <p>Si tienes alguna pregunta, no dudes en <a href="mailto:soporte@example.com">contactarnos</a>. Estamos
                aquí
                para ayudarte.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>¡Cuida a tu mascota como se merece! 🐾</p>
            <p><a href="https://veterinaria-san-agustin.com">Visita nuestra tienda</a> para más productos y servicios.
            </p>
            <p>© 2024 Hospital Veterinario San Agustín. Todos los derechos reservados.</p>
            <p>Desarrollado por œAlchemy Software.</p>
        </div>
    </div>
</body>
