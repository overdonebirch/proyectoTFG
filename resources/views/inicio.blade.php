@extends('layouts.plantilla')

@section('topInicio')

    <section class="row inicio__primeraSeccion">
        <div class="row d-flex margen-pag-inicio">

            <div class="col-md-12 d-flex justify-content-start  align-items-end "><p class="textoPromocional"> No lo pienses mucho.</p></div>
            <div class="col-md-12 d-flex justify-content-start"><p class="textoPromocional"> Apúntate ya.</p></div>
            <div class="col-md-12 d-flex justify-content-start"> <button type="button" class="btn boton justify-content-center textoBoton textoBoton-fondoBlanco color-blanco">Apúntate</button></div>

        </div>
    </section>


@endsection



@section('medioInicio')


<section class="row inicio__segundaSeccion">
    <div class="row d-flex">

        <div class="col-md-12 d-flex justify-content-center ">
            <p class="textoPromocional__subtitulo texto-negro mt-5">Mejor aquí que en casa viendo la tv</p>
        </div>

        <div class="row d-flex justify-content-center margen-pag-inicio">
            <div class="col-md-4">
                <div class="col-md-12 d-flex justify-content-start">
                    <p class="textoPromocional texto-color-secundario mt-5">Prueba un día gratis en el gym</p>
                </div>
                <div class="col-md-12 d-flex justify-content-start">
                    <p class="textoPromocional__subtitulo texto-negro mt-5">Acceso completo a la sala fitness</p>
                </div>
                <div class="col-md-12 d-flex justify-content-start">
                    <p class="textoPromocional__subtitulo texto-negro mt-5">Acceso a las clases de cardio y relajación</p>
                </div>
                <div class="col-md-12 d-flex justify-content-start">
                    <button type="button" class="btn boton-ancho justify-content-center textoBoton color-secundario mt-5">Día de prueba</button>
                </div>
            </div>
            <div class="col-md-8 d-flex justify-content-center">
                <img  src="{{asset('assets/img/mancuernas.jpg') }}"/>
            </div>
        </div>

    </div>
</section>


    <section class="row inicio__terceraSeccion mt-5 imagenFondo" >

        <div class="col-md-12 d-flex justify-content-center">
            <p class="mt-5 textoPromocional__subtitulo">Disfruta de las mejores clases para tonificar</p>
        </div>


        <div class="col-md-12 d-flex justify-content-start margen-pag-inicio align-items-end">
            <p class="mt-5 textoPromocional__subtitulo">*Acceso ilimitado con membresía Premium</p>
        </div>
        <div class="col-md-12 d-flex justify-content-start margen-pag-inicio">
            <button type="button" class="btn boton-ancho justify-content-center textoBoton color-principal">Hazte Premium</button>
        </div>

    </section>






@endsection
