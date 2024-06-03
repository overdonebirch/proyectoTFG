@extends('layouts.plantilla')

@section('middle')

    <section class="row container-fluid mt-5">
        <form id="formDniReserva" action="{{ route('reservasUsuario') }}" method="GET">
            <div class="col-lg-12 d-flex justify-content-center">
                <p class="texto-negro">Introduce tu DNI para buscar reservas:</p>
                <input type="text" id="dni" class="texto-negro texto-color-secundario" style="padding-left: 10px"/>
                <input type="hidden" id="dniHidden" name="dniReserva" class="texto-negro texto-color-secundario" style="padding-left: 10px"/>
                <button type="submit" class="btn boton justify-content-center textoBoton color-secundario" style="margin-left: 10px">Buscar</button>
            </div>
        </form>
    </section>

    <script>
        document.getElementById('formDniReserva').addEventListener('submit', function (event) {
            var dni = document.getElementById('dni').value;
            var regex = /^[XYZ0-9][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;

            if (!regex.test(dni)) {
                event.preventDefault(); // Evita que el formulario se envíe si la validación falla
                let mensaje = document.createElement("p");
                mensaje.innerHTML = "El DNI no tiene el formato correcto";
                mensaje.style.backgroundColor = 'red';
                mensaje.style.color = 'white'; // Para que el texto sea legible
                mensaje.style.padding = '10px';
                mensaje.style.borderRadius = '5px';
                mensaje.classList.add("centrar")
                let mensajes = document.getElementById("mensajes");
                mensajes.innerHTML = ""; // Limpiar mensajes anteriores
                mensajes.appendChild(mensaje);
                setTimeout(() => {
                    mensajes.innerHTML = "";
                }, 3000);
            } else {
                document.getElementById('dniHidden').value = dni;
            }
        });
    </script>

@endsection
