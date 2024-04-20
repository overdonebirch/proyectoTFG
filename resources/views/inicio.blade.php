@extends('layouts.plantilla')

@section('topInicio')

@component('_components.inicio.primeraSeccion')

@endcomponent


@endsection



@section('medioInicio')

    @component('_components.inicio.segundaSeccion')

    @endcomponent


    @component('_components.inicio.terceraSeccion')

    @endcomponent



    @component('_components.inicio.cuartaSeccion')

    @endcomponent









@endsection
