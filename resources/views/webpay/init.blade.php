<!-- init.blade.php -->

<style>
    body {
        font-family: 'Roboto', sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        text-align: center;
        margin-top: 20%;
    }

    h1 {
        font-size: 1.8rem;
        color: #333;
    }

    /* Estilos del spinner */
    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid #6b196b;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
        margin: 20px auto;
    }

    /* Animación del spinner */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Mensaje de error */
    .error-message {
        color: #a94442;
        font-size: 1.2rem;
        margin-top: 20px;
    }
</style>

<body>
    <div class="container">
        <h1>Redirigiendo a Webpay...</h1>

        <!-- Spinner de carga -->
        <div class="spinner"></div>

        @if(isset($response))
            <form method="POST" action="{{ $response->url }}">
                <input type="hidden" name="token_ws" value="{{ $response->token }}" />
            </form>
        @else
            <p class="error-message">Ocurrió un error al iniciar la transacción.</p>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Si el formulario existe, esperar 3 segundos y enviarlo automáticamente
            if (document.querySelector('form')) {
                setTimeout(function() {
                    document.querySelector('form').submit();
                }, 3000); // Ajusta el tiempo según lo necesites
            }
        });
    </script>
</body>
