@extends('layouts.plantilla')



    @if ($user && ($user->empleado))
        @section('middle')
            @component('_components.inicio.empleado.panelOpciones')

            @endcomponent
        @endsection
    @else
        @section('top')

            @component('_components.inicio.cliente.primeraSeccion')

            @endcomponent


        @endsection


        @section('middle')

            @component('_components.inicio.cliente.segundaSeccion')

                @if (Route::has('login'))
                @auth
                    @slot('gimnasio_id',$gimnasioUser->_id)
                @endauth
                @endif

            @endcomponent

            @if(!Auth::user())
                @component('_components.inicio.cliente.terceraSeccion')

                @endcomponent
            @endif


            @component('_components.inicio.cliente.cuartaSeccion')

            @endcomponent


        @endsection
    @endif




