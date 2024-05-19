<header class="container-fluid">
    <section class="row  cabecera d-flex align-items-center">
        <div class="col-md-3 d-flex justify-content-center "><a href="{{route('inicio')}}" class="titulo">Vitality</a></div>
        <div class="col-md-3 d-flex justify-content-center"><a href="{{route('dondeEstamos')}}" class="texto-menu">Donde estamos</a></div>
        <div class="col-md-1 d-flex justify-content-center"><a href="{{route('clases')}}" class="texto-menu">Ver Clases</a><</div>
        <div class="col-md-2 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3">
            <a href="{{route ('formRegistro')}}" type="button" class="btn boton justify-content-center textoBoton color-principal">Hazte Socio</a>
        </div>

        @if (Route::has('login'))

            @auth

                <div class="col-md-2 d-flex justify-content-md-start justify-content-center mt-md-0 mt-3">
                    <a href="{{route ('logout')}}"type="button" class="btn boton justify-content-center textoBoton color-secundario">Cerrar Sesión</a>
                </div>

            @else

                <div class="col-md-2 d-flex justify-content-md-start justify-content-center mt-md-0 mt-3">
                    <a href="{{route ('login')}}"type="button" class="btn boton justify-content-center textoBoton color-secundario">Iniciar Sesión</a>
                </div>

            @endauth

        @endif



    </section>
</header>
