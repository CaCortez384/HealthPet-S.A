@props(['status'])

<link href="{{ asset('css/boton-sucess-style.css') }}" rel="stylesheet">

{{-- Mostrar el mensaje de estado si existe --}}
@if ($status)
    <div class="alert alert-dismissible fixed-bottom fade show" id="customAlert" role="alert">
        {{ $status }}
        <button type="button" class="close no-style" data-dismiss="alert" aria-label="Close" id="closeAlertButton">
            <p id="aceptar">Aceptar</p>
        </button>
    </div>
@endif
