@extends('layouts.plantilla')

@section('top')

@component('_components.inicio.primeraSeccion')

@endcomponent


@endsection



@section('middle')

    @component('_components.inicio.segundaSeccion')
        @if (Route::has('login'))
        @auth
            @slot('gimnasio_id',$gimnasioUser->_id)
        @endauth
        @endif

    @endcomponent


    @component('_components.inicio.terceraSeccion')

    @endcomponent



    @component('_components.inicio.cuartaSeccion')

    @endcomponent









@endsection
