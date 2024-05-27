@extends('layouts.plantilla')

@section('middle')
<div class="container">
    <h1>Mis Reservas</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre Gimnasio</th>
                <th>Nombre Clase</th>
                <th>Fecha</th>
                <th>Hora Inicio</th>
                <th>Hora Fin</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservas as $reserva)
                <tr>
                    <td>{{ $reserva->gimnasio->nombre }}</td>
                    <td>{{ $reserva->clase->nombre }}</td>
                    <td>{{ $reserva->fecha }}</td>
                    <td>{{ $reserva->hora_inicio }}</td>
                    <td>{{ $reserva->hora_fin }}</td>
                    @if (Route::has('login'))
                        <td>
                            <form action="{{route('reserva.destroy', $reserva)}}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-dark ms-3" style="margin-top:5px; margin-bottom:5px;"type="submit">Eliminar reserva </button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@endsection
