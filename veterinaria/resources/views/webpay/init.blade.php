<x-home>

    
<!-- init.blade.php -->


    <style>
        .container {
            text-align: center;
            margin-top: 20%;
        }
        .btn {
            border: 1px solid #6b196b;
            border-radius: 4px;
            background-color: #6b196b;
            color: #fff;
            font-family: Roboto, Arial, Helvetica, sans-serif;
            font-size: 1.14rem;
            font-weight: 500;
            padding: 12px;
            text-align: center;
            transition: .2s ease-in-out;
            max-width: 200px;
            margin: auto;
        }
    </style>

<body>
    <div class="container">
        <h1>Redirigiendo a Webpay...</h1>
        @if(isset($response))
            <form method="POST" action="{{ $response->url }}">
                <input type="hidden" name="token_ws" value="{{ $response->token }}" />
                <input type="submit" class="btn" value="Continuar a Webpay" />
            </form>
        @else
            <p>Ocurrió un error al iniciar la transacción.</p>
        @endif
    </div>
</body>


</x-home>
