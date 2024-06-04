<section class="row inicio__primeraSeccion">

    <div class="row d-flex margen-pag-inicio">

        @if (Route::has('login'))

            @auth
                <div class="col-md-12 d-flex justify-content-start  align-items-center "><p class="textoPromocional"> Comprueba tus datos</p></div>
                <div class="col-md-12 d-flex justify-content-start"> <a type="button" href="{{route('perfil')}}" class="btn boton justify-content-center textoBoton textoBoton-fondoBlanco color-blanco">Ver tus datos</a></div>
            @else
                <div class="col-md-12 d-flex justify-content-start  align-items-end "><p class="textoPromocional"> No lo pienses mucho.</p></div>
                <div class="col-md-12 d-flex justify-content-start"><p class="textoPromocional"> Apúntate ya.</p></div>
                <div class="col-md-12 d-flex justify-content-start"> <a type="button" href="{{route('formRegistro')}}" class="btn boton justify-content-center textoBoton textoBoton-fondoBlanco color-blanco">Apúntate</a></div>
            @endauth

        @endif








    </div>
</section>
