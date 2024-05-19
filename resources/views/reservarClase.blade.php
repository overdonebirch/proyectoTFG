@extends('layouts.plantilla')

@section("middle")

<section class="row container-fluid  mt-5 ">


    <div class="col-lg-12 d-flex justify-content-center " >
        <p class="texto-negro">Clase a reservar: </p>
        <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> {{  $clase->nombre}} </p>
    </div>

    <div class="col-lg-12 d-flex justify-content-center " >
        <p class="texto-negro">Fecha:</p>
        <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> {{$fecha}}</p>
    </div>

    <div class="col-lg-12 d-flex justify-content-center " >
        <p class="texto-negro">Hora Inicio:</p>
        <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> {{$horaInicio}} </p>
    </div>


    <div class="col-lg-12 d-flex justify-content-center " >
        <p class="texto-negro">Hora Fin:</p>
        <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> {{$horaFin}} </p>
    </div>

    <div class="col-lg-12 d-flex justify-content-center " >
        <p class="texto-negro">Gimnasio: </p>
        <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> {{$gimnasio->nombre}}</p>
    </div>

    <div class="col-lg-12 d-flex justify-content-center " >

        <a href="{{route ('clases')}}"type="button" class="btn boton justify-content-center textoBoton color-principal">Volver</a>

        @php
            //Ruta para el store :
            $route = route('reservar', ['clase' => $clase->_id, 'fecha' => $fecha, 'horaInicio' => $horaInicio,'horaFin' => $horaFin, 'gimnasio' => $gimnasio->_id, "dniUsuario" => $dni]);

        @endphp

        <form method="POST" action="{{$route}}">
            @csrf
            <button type="submit "class="btn boton justify-content-center textoBoton color-secundario" style="margin-left: 10px"> Reservar </button>
        </form>

    </div>



</section>


@endsection
