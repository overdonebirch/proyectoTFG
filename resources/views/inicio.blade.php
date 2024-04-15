@extends('layouts.plantilla')
@section('topInicio')

    <section class="row inicio__primeraSeccion">
        <div class="row d-flex m-left-inicioTop">
            <div class="col-md-12 d-flex justify-content-start  align-items-end "><p class="textoPromocional"> No lo pienses mucho.</p></div>
            <div class="col-md-12 d-flex justify-content-start"><p class="textoPromocional"> Apúntate ya.</p></div>
            <div class="col-md-12 d-flex justify-content-start"><p class="textoPromocional"> <button type="button" class="btn boton justify-content-center textoBoton textoBoton-fondoBlanco color-blanco">Apúntate</button></div>
        </div>
    </section>


@endsection



@section('medioInicio')


    <section class="row inicio__segundaSeccion">
        <div class="row d-flex m-left-inicioTop">
            <div class="col-md-12 d-flex justify-content-center  align-items-end "><p class="textoPromocional__subtitulo texto-negro mt-5"> Mejor aquí que en casa viendo la tv </p></div>
            <div class="col-md-12 d-flex justify-content-start"><p class="textoPromocional texto-color-secundario mt-5"> Prueba un día gratis en el gym</p></div>
            <div class="col-md-12 d-flex justify-content-start"><p class="textoPromocional__subtitulo texto-negro mt-5"> Acceso completo a la sala fitness</p></div>
            <div class="col-md-12 d-flex justify-content-start"><p class="textoPromocional__subtitulo texto-negro mt-5"> Acceso a las clases de cardio y relajación</p></div>
            <button type="button" class="btn boton-ancho justify-content-center textoBoton color-secundario mt-5">Día de prueba</button>
            {{-- <img src="{{ asset('assets/img/GrupoEjercitando.jpg') }}"/> --}}
        </div>
    </section>


    <section class="row inicio__terceraSeccion mt-5 imagenFondo" >
                <p>texto</p>
    </section>






@endsection
