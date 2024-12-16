<body style="font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f8f9fa; color: #333; line-height: 1.6;">
    <table style="max-width: 650px; width: 100%; margin: 20px auto; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); overflow: hidden; border-collapse: collapse;">
        <!-- Header -->
        <tr>
            <td style="background-color: #f77f00; color: #ffffff; text-align: center; padding: 20px;">
                <img src="https://webalchemy.live/img/logo.png" alt="Logo" style="max-width: 80px; border-radius: 50%; margin-bottom: 10px;">
                <h1 style="margin: 0; font-size: 24px; font-weight: bold;">Seguimiento de Pedido</h1>
            </td>
        </tr>

        <!-- Información del Pedido -->
        <tr>
            <td style="padding: 20px;">
                <h2 style="font-size: 20px; color: #f77f00;"> ¡Hola {{ $data['nombre'] }}</h2>
                <p style="margin: 5px 0;">{{ $data['mensaje2'] }}</strong></p>
                <p style="margin: 5px 0;">Número de pedido: <strong>{{ $data['pedido_id'] }}</strong></p>

                <!-- Progreso del Pedido -->
                <div style="display: flex; justify-content: space-around; margin: 20px 0;">
                    <div style="width: 35px; height: 35px; border-radius: 50%; background-color: {{ $data['estado_pedido'] >= 1 ? '#f77f00' : '#c0d9e4' }}; display: flex; justify-content: center; align-items: center; color: #fff;">1</div>
                    <div style="width: 35px; height: 35px; border-radius: 50%; background-color: {{ $data['estado_pedido'] >= 2 ? '#f77f00' : '#c0d9e4' }}; display: flex; justify-content: center; align-items: center; color: #fff;">2</div>
                    <div style="width: 35px; height: 35px; border-radius: 50%; background-color: {{ $data['estado_pedido'] >= 3 ? '#f77f00' : '#c0d9e4' }}; display: flex; justify-content: center; align-items: center; color: #fff;">3</div>
                    <div style="width: 35px; height: 35px; border-radius: 50%; background-color: {{ $data['estado_pedido'] >= 4 ? '#f77f00' : '#c0d9e4' }}; display: flex; justify-content: center; align-items: center; color: #fff;">4</div>
                </div>

                <!-- Detalles de Productos -->
                <h2 style="font-size: 18px; margin-top: 20px;">Detalles de Productos</h2>
                <table style="width: 100%; border-collapse: collapse; margin: 10px 0;">
                    <thead>
                        <tr>
                            <th style="text-align: left; padding: 10px; border-bottom: 2px solid #ddd;">Producto</th>
                            <th style="text-align: center; padding: 10px; border-bottom: 2px solid #ddd;">Cantidad</th>
                            <th style="text-align: center; padding: 10px; border-bottom: 2px solid #ddd;">Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['productos'] as $producto)
                        <tr>
                            <td style="padding: 10px; border-bottom: 1px solid #eee;">{{ $producto['nombre'] }}</td>
                            <td style="text-align: center; padding: 10px; border-bottom: 1px solid #eee;">{{ $producto['cantidad'] }}</td>
                            <td style="text-align: center; padding: 10px; border-bottom: 1px solid #eee;">{{ $producto['precio'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Total -->
                <p style="margin: 20px 0; text-align: right; font-size: 18px; font-weight: bold;">Total: ${{ number_format($data['monto_pagado'], 0, ',', '.') }}</p>
            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="text-align: center; background-color: #f8f9fa; padding: 20px; font-size: 14px; color: #666;">
                <p>Gracias por tu compra. Si tienes preguntas, <a href="mailto:soporte@empresa.com" style="color: #f77f00; text-decoration: none;">contáctanos</a>.</p>
            </td>
        </tr>
    </table>
</body>
