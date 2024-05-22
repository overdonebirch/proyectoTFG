@extends('layouts.plantilla')

@section("middle")

<section class="row container-fluid  mt-5 ">


    <div class="col-lg-12 d-flex justify-content-center " >
        <p class="texto-negro">Vemos que no estas logado. ¿ Quieres reservar la clase por un precio de </p>
        <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> {{$precio}}€ ?</p>

    </div>

    <div class="col-lg-12 d-flex justify-content-center " >
        <p class="texto-negro">Si es así, introduce tu DNI : </p>
        <input type="text" id="dniNoUsuario" class="texto-negro texto-color-secundario" style="padding-left: 10px "/>

    </div>


    <div class="col-lg-12 d-flex justify-content-center  mt-5" >

        <a href="{{route ('clases')}}"type="button" class="btn boton justify-content-center textoBoton color-principal">Volver</a>


        <form method="POST" id="reservarForm" action="{{route('bookingPayment')}}">

            @csrf
            <input type="hidden" name="id_clase" value="{{ $clase->_id }}">
            <input type="hidden" name="fecha" value="{{ $fecha }}">
            <input type="hidden" name="horaInicio" value="{{ $horaInicio }}">
            <input type="hidden" name="horaFin" value="{{ $horaFin }}">
            <input type="hidden" name="id_gimnasio" value="{{ $gimnasio->_id }}">
            <input type="hidden" name="precio" value="{{ $precio }}">
            <input type="hidden" name="dni_usuario" id="dniHidden">

            <button type="submit "class="btn boton justify-content-center textoBoton color-secundario" style="margin-left: 10px"> Reservar </button>
        </form>

    </div>



</section>

<script>
    document.getElementById('reservarForm').addEventListener('submit', function (event) {
        var dni = document.getElementById('dniNoUsuario').value;
        var regex = /^[XYZ0-9][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;

        if (!regex.test(dni)) {
            event.preventDefault(); // Evita que el formulario se envíe si la validación falla
            let mensaje = document.createElement("p");
            mensaje.innerHTML = "El DNI no tiene el formato correcto";
            mensaje.style.backgroundColor = 'red';
            mensaje.style.height = '100%';
            mensaje.style.width = '100%';
            mensaje.classList.add("centrar")
            let mensajes = document.getElementById("mensajes");
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
