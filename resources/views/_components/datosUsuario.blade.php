<section class="row container-fluid  mt-5 ">
    <div class="col-lg-6 d-flex justify-content-end " >
        <img class="imagen-perfil" src="{{asset('assets/img/perfil-sin-foto.jpg') }}" >
    </div>

    <div class="col-lg-6 d-flex flex-column">
        <div class="d-flex">
            <p class="texto-negro">Nombre:  </p>
            <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> {!! $nombre !!}</p>
        </div>
        <div class="d-flex">
            <p class="texto-negro">Apellidos </p>
            <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> {{ $apellidos }} </p>
        </div>
        <div class="d-flex">
            <p class="texto-negro">Membresía:  </p>
            <p class="texto-negro texto-color-principal" style="padding-left: 10px "> {{ $membresia}} </p>
        </div>
        <div class="d-flex">
            <p class="texto-negro">Email:  </p>
            <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> {{ $email }} </p>
        </div>
        <div class="d-flex">
            <p class="texto-negro">Gimnasio:  </p>
            <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> {{ $gimnasioNombre }} </p>
        </div>

        <div class="d-flex">
            <p class="texto-negro">Cliente desde:  </p>
            <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> {{ $fecha_registro }} </p>
        </div>
        {{$reservas}}
</section>
