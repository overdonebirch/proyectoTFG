<section class="container-fluid">

    <section class="row contenedor__botones mt-5">

        <div class="col-md-6 d-flex flex-column justify-content-start align-items-center">

            <p class="textoPromocional__subtitulo texto-negro" > Horarios </p>

            <p class="textoPromocional__subtitulo texto-negro"> Lunes a Viernes:  </p>
            <p class="texto-negro">{{$lunesaviernes}}</p>
            <p class="textoPromocional__subtitulo texto-negro"> Sábados:  </p>
            <p class="texto-negro">{{$sabados}}</p>
            <p class="textoPromocional__subtitulo texto-negro"> Domingos y festivos:  </p>
            <p class="texto-negro">{{$domingosyfestivos}}</p>

       </div>


       <div class="col-md-6 d-flex flex-column justify-content-start align-items-center">

            <p class="textoPromocional__subtitulo texto-negro" > Dirección : </p>
            <p class="texto-negro">{{$direccion}}</p>

       </div>

    </section>

</section>
