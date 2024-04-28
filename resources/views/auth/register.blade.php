@extends('layouts.plantilla')

@section('middle')


<form action = "{{ route('registro') }}" method="post" >
    @csrf
    <div class="container px-4 px-lg-5 color-form rounded p-4 mt-5" style="width: 30%;">
        <!-- Contenido del contenedor... -->
        <div class="mb-3">
             <label for="formGroupExampleInput" class="form-label text-white">Nombre :</label>
             <input type="text" class="form-control w-100 texto-negro" id="formGroupExampleInput" name="nombre" placeholder="nombre">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label text-white">Apellidos:</label>
            <input type="text" class="form-control w-100 texto-negro" id="formGroupExampleInput2" name="apellidos" placeholder="apellidos">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text-white">Email:</label>
            <input type="email" class="form-control w-100 texto-negro" step="any" id="formGroupExampleInput" name="email" min="0" placeholder="email">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text-white">Dni:</label>
            <input type="text" class="form-control w-100 texto-negro" step="any" id="formGroupExampleInput" name="dni" min="0" placeholder="dni">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text-white">Password:</label>
            <input type="password" class="form-control w-100 texto-negro" step="any" id="formGroupExampleInput" name="password" min="0" placeholder="password">
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label text-white">Eligen tu gimnasio:</label>
            <select class="form-select w-100" name="id_gimnasio">
                @foreach ($gimnasios as $g)
                    <option value="{{ $g->_id }}" >{{ $g->nombre }}</option>
                 @endforeach
            </select>
        </div>
    <button type="submit" class="btn btn-light">Registrarse</button>
</div>
</form>

@endsection
