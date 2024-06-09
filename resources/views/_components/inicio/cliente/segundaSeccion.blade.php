@if (Route::has('login'))

@auth
    <div class="col-md-12 d-flex justify-content-center">
        <p class="textoPromocional__subtitulo texto-negro mt-5">Elige una clase de tu gimnasio : </p>
    </div>
    <form id="gimnasio-form" method="GET" action="{{ route('clases') }}">
        <div class="col-md-12 d-flex justify-content-center">
            <input type="hidden" name="gimnasio_id" value="{{$gimnasio_id}}">
            <button type="submit" class="btn boton-ancho justify-content-center textoBoton color-secundario mt-5">Ver clases</button>
        </div>
    </form>

@else

    <section class="row inicio__segundaSeccion container-fluid mt-5 ">
        <div class="col-md-12 d-flex justify-content-center">
            <p class="textoPromocional__subtitulo texto-negro mt-5">Mejor aquí que en casa viendo la tv</p>
        </div>

        <div class="row d-flex justify-content-center margen-pag-inicio">
            <div class="col-md-6">
                <div class="col-md-12 d-flex justify-content-start">
                    <p class="textoPromocional texto-color-secundario mt-5">Empieza tu entrenamiento </p>
                </div>
                <div class="col-md-12 d-flex justify-content-start">
                    <p class="textoPromocional__subtitulo texto-negro mt-5">Acceso completo a la sala fitness</p>
                </div>
                <div class="col-md-12 d-flex justify-content-start">
                    <p class="textoPromocional__subtitulo texto-negro mt-5">Acceso a las clases de cardio y relajación con membresía básica</p>
                </div>
                <div class="col-md-12 d-flex justify-content-start">
                    <p class="textoPromocional__subtitulo texto-negro mt-5">Acceso adicional a las clases de tonificar y baile con membresía premium</p>
                </div>

            </div>
            <div class="col-md-6 mt-5 d-flex justify-content-center">
                <img  class="img-promocion"src="{{asset('assets/img/mancuernas.png') }}"/>
            </div>
        </div>
    </section>


@endauth

@endif


