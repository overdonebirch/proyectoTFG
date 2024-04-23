@extends('layouts.plantilla')

@section('top')

    <section class="row container-fluid  mt-5 ">
        <div class="col-lg-1 d-flex justify-content-center" >

        </div>
        <div class="col-lg-3 d-flex justify-content-center " >
            <p class="textoPromocional texto-negro texto__buscanos">Nuestros Gimnasios</p>
        </div>


        <div class="col-lg-8 d-flex justify-content-center align-items-center " style="padding-left: 25rem;">
            <input type="text" placeholder="Busca tu ciudad" class="textoPromocional texto-negro input__buscaciudad"/>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye-search" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#F86666" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M12 18c-.328 0 -.652 -.017 -.97 -.05c-3.172 -.332 -5.85 -2.315 -8.03 -5.95c2.4 -4 5.4 -6 9 -6c3.465 0 6.374 1.853 8.727 5.558" />
                <path d="M18 18m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                <path d="M20.2 20.2l1.8 1.8" />
              </svg>
        </div>

    </section>

@endsection



@section('middle')

    <section class="row container-fluid  mt-5 d-flex justify-content-start margen-pag-dondeestamos">

    @foreach ($gimnasios as $gym)

         @component('_components.dondeEstamos.iconoGimnasio')
                @slot('gimnasio',$gym)
                @slot('nombregimnasio',$gym->nombre)

         @endcomponent


    @endforeach






    </section>


@endsection
