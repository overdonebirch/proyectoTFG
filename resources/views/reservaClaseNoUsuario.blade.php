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


        <form method="POST" action="{{route('bookingPayment')}}">

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
    document.querySelector('form').addEventListener('submit', function () {
        var dni = document.getElementById('dniNoUsuario').value;
        document.getElementById('dniHidden').value = dni;
    });
</script>


@endsection
