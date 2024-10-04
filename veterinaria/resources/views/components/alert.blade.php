
<link href="{{ asset('css\boton-sucess-style.css') }}" rel="stylesheet">
@if (session('success'))
    <div class="alert alert-dismissible fixed-bottom fade show" id="customAlert" role="alert">
        {{ session('success') }}
        <button type="button" class="close no-style" data-dismiss="alert" aria-label="Close" id="closeAlertButton">
            <p id="aceptar">Aceptar</p>
        </button>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const alertBox = document.getElementById('customAlert');
        const closeButton = document.getElementById('closeAlertButton');

        if (alertBox) {
            // Cerrar el alert al hacer clic en el botón "Aceptar"
            closeButton.addEventListener('click', function() {
                alertBox.style.display = 'none';
            });

            // Cerrar el alert al hacer clic fuera de él
            document.addEventListener('click', function(event) {
                // Verificar si el clic no fue dentro del alert o en el botón de cierre
                if (!alertBox.contains(event.target) && event.target !== closeButton) {
                    alertBox.style.display = 'none';
                }
            });
        }
    });
</script>