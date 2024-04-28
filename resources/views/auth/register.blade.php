@extends('layouts.plantilla')

@section('middle')

<form method="POST" action="{{ route('registro') }}">
    @csrf
    <input type="text" name="nombre" placeholder="Name">
    <br>
    <input type="text" name="apellidos" placeholder="apellidos">
    <br>
    <input type="email" name="email" placeholder="Email">
    <br>
    <input type="password" name="password" placeholder="Password">
    <br>
    <input type="text" name="dni" placeholder="dni">
    <br>
    <select  name="id_gimnasio">
        @foreach ($gimnasios as $g)
            <option value="{{ $g->_id }}" >{{ $g->nombre }}</option>
         @endforeach
    </select>
    <br>
    <button type="submit">Register</button>

</form>


@endsection
