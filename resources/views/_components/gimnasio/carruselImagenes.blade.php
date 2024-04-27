<section class="container-fluid">

    <section class="row">
        <section class="col-md-12 d-flex justify-content-center">

            <a class=" " href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="sr-only negro">Anterior</span>
            </a>
            <a class=" " href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" ></span>
                <span class="sr-only negro">Siguiente</span>
            </a>

        </section>
    </section>


    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">


        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <!-- Agrega más indicadores según sea necesario -->
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row">
                    <div class="col-4">
                        <img class="d-block w-100" src="{{asset('assets/img/maquinas.jpg') }}" alt="First slide">
                    </div>
                    <div class="col-4">
                        <img class="d-block w-100" src="{{asset('assets/img/maquinas2.jpg') }}" alt="Second slide">
                    </div>
                    <div class="col-4">
                        <img class="d-block w-100" src="{{asset('assets/img/maquinas.jpg') }}" alt="Third slide">
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row">
                    <div class="col-4">
                        <img class="d-block w-100" src="{{asset('assets/img/maquinas.jpg') }}" alt="First slide">
                    </div>
                    <div class="col-4">
                        <img class="d-block w-100" src="{{asset('assets/img/maquinas2.jpg') }}" alt="Second slide">
                    </div>
                    <div class="col-4">
                        <img class="d-block w-100" src="{{asset('assets/img/maquinas.jpg') }}" alt="Third slide">
                    </div>
                </div>
            </div>
            <!-- Agrega más elementos de carousel-item según sea necesario -->
        </div>


    </div>
