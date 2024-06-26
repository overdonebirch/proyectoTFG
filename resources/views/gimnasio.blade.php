@extends('layouts.plantilla')

@section('top')

    <section class="container-fluid">


        <section class=" row top__gimnasio imagenFondo__top__gimnasio d-flex justify-content-center" style="margin-top: -5px">
            <h1 class="textoPromocional texto-color-secundario texto__titulo" style="text-align: center;">{{$gimnasio->nombre}}</h1>
        </section>

    </section>

@endsection



@section('middle')

    @component('_components.gimnasio.botonesGimnasio')
        @slot('inscribete')
            <a type="button" type="button" href="{{route('formRegistro')}}"class="btn boton__gym__especifico d-flex justify-content-center align-items-center textoBoton  texto-negro">Inscríbete Aqui</a>
        @endslot

        @slot('verClases')
            <form action="{{route('clases')}}" method="GET">
                <input type="hidden" name="gimnasio_id" value="{{$gimnasio->_id}}"/>
                <button type="submit" class="btn boton__gym__especifico justify-content-center textoBoton texto-negro">Ver Clases</button>
            </form>
        @endslot
    @endcomponent


    @component('_components.gimnasio.carruselImagenes')

    @endcomponent



    @component('_components.gimnasio.datosGimnasio')
        @slot('lunesaviernes',"de ". $gimnasio->horarios["lunes_a_viernes"]["apertura"]. " a ".$gimnasio->horarios["lunes_a_viernes"]["cierre"] )
        @slot('sabados',"de ". $gimnasio->horarios["sabados"]["apertura"]. " a ".$gimnasio->horarios["sabados"]["cierre"] )
        @slot('domingosyfestivos',"de ". $gimnasio->horarios["domingos_y_festivos"]["apertura"]. " a ".$gimnasio->horarios["domingos_y_festivos"]["cierre"] )

        @slot('direccion', $gimnasio->direccion)
    @endcomponent

@endsection
