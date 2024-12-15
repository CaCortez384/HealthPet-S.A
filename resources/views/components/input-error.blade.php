@props(['messages'])




@if ($messages)
    <div class="alert alert-dismissible fixed-bottom fade show" id="customAlert" role="alert">
        @foreach ((array) $messages as $message)
        {{ $message }}
    @endforeach
        <button type="button" class="close no-style" data-dismiss="alert" aria-label="Close" id="closeAlertButton">
            <p id="aceptar">Aceptar</p>
        </button>
    </div>
@endif
