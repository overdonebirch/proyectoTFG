@extends('layouts.plantilla')

@section('top')

@component('_components.inicio.primeraSeccion')

@endcomponent


@endsection



@section('middle')

    @component('_components.inicio.segundaSeccion')

    @endcomponent


    @component('_components.inicio.terceraSeccion')

    @endcomponent



    @component('_components.inicio.cuartaSeccion')

    @endcomponent









@endsection
