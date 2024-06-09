@extends('layouts.plantilla')

@section('top')

    <section class="row container-fluid  mt-5 ">
        <div class="col-lg-1 d-flex justify-content-center" >

        </div>
        <div class="col-lg-3 d-flex justify-content-center " >
            <p class="textoPromocional texto-negro texto__buscanos">Nuestros Gimnasios</p>
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
