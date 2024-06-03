@extends('layouts.plantilla')

@section('middle')

    <section class="row container-fluid mt-5">
        <form id="formDniEdit" action="{{ route('editUser') }}" method="GET">
            <div class="col-lg-12 d-flex justify-content-center ">
                <p class="texto-negro ">Introduce El dni del usuario que quieras consultar</p>
                <input type="text" id="dni" class="texto-negro texto-color-secundario" style="padding-left: 10px"/>
                <input type="hidden" id="dniHidden" name="dniUsuario" class="texto-negro texto-color-secundario" style="padding-left: 10px"/>
                <button type="submit" class="btn boton justify-content-center textoBoton color-secundario" style="margin-left: 10px">Buscar</button>
            </div>
        </form>
    </section>


@if ($user)

<form  action="{{ route('updateUser',$user) }}" method="POST">

    @csrf
    @method('PUT')

    @component('_components.datosUsuario')

        @slot('nombre')
            <input type="text" name="nombre" class="texto-color-secundario" value="{{ $user->nombre }}">
        @endslot

        @slot('apellidos')
            <input type="text" name="apellidos" class="texto-color-secundario" value="{{ $user->apellidos }}">
        @endslot

        @slot('membresia',$user->membresia["nombre"])

        @slot('email')
            <input type="email" name="email" class="texto-color-secundario" value="{{ $user->email }}">
        @endslot

        @slot('gimnasioNombre')
            <select class="form-select w-100 texto-color-secundario" name="id_gimnasio">
                @foreach ($gimnasios as $g)
                    <option class="texto-color-secundario"value="{{ $g->_id }}" >{{ $g->nombre }}</option>
                @endforeach
            </select>
        @endslot

        @slot('fecha_registro',$user->fecha_registro)

        @slot('reservas')
            <button type="submit" class="btn boton justify-content-end textoBoton color-secundario">Actualizar usuario</button>
        @endslot

    @endcomponent

</form>

@endif



    <script>
        document.getElementById('formDniEdit').addEventListener('submit', function (event) {
            var dni = document.getElementById('dni').value;
            var regex = /^[XYZ0-9][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;

            if (!regex.test(dni)) {
                event.preventDefault(); // Evita que el formulario se envíe si la validación falla
                let mensaje = document.createElement("p");
                mensaje.innerHTML = "El DNI no tiene el formato correcto";
                mensaje.style.backgroundColor = 'red';
                mensaje.style.color = 'white'; // Para que el texto sea legible
                mensaje.style.padding = '10px';
                mensaje.style.borderRadius = '5px';
                mensaje.classList.add("centrar")
                let mensajes = document.getElementById("mensajes");
                mensajes.innerHTML = ""; // Limpiar mensajes anteriores
                mensajes.appendChild(mensaje);
                setTimeout(() => {
                    mensajes.innerHTML = "";
                }, 3000);
            } else {
                document.getElementById('dniHidden').value = dni;
            }
        });
    </script>

@endsection
