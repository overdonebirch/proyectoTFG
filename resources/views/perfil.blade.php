@extends('layouts.plantilla')

@section('middle')

    @component('_components.datosUsuario')
        @slot('nombre',$user->nombre)
        @slot('apellidos',$user->apellidos)
        @slot('membresia',$user->membresia["nombre"])
        @slot('email',$user->email)
        @slot('gimnasioNombre',$gimnasio->nombre)
        @slot('fecha_registro',$user->fecha_registro)
        @slot('reservas')
        @if($reservas->count() <= 0 )
            <div class="d-flex">
                <p class="texto-negro texto-color-secundario" style="padding-left: 10px "> No tienes reservas de clases </p>
            </div>
            @else
                <div class="d-flex">
                    <a href="{{'reservasUsuario'}}"class="texto-negro texto-color-principal" style="padding-left: 10px; text-decoration:underline; font-size:20px"> Ver tus clases reservadas</a>
                </div>
            @endif
        @endslot
    @endcomponent


@endsection
