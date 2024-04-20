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

    @endcomponent


    <section class="container-fluid">

        <section class="row contenedor__botones">

                <div class="col-md-12 d-flex justify-content-center align-items-start">
                     <p class="textoPromocional__subtitulo texto-negro">Fotos De Las Instalaciones</p>
                </div>


        </section>

    </section>

    @component('_components.gimnasio.datosGimnasio')

    @endcomponent

@endsection
