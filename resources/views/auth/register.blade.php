@extends('layouts.plantilla')

@section('middle')


<form action = "{{ route('payment') }}" method="get" >
    @csrf
    <div class="container px-4 px-lg-5 color-form rounded p-4 mt-5" style="width: 30%;">
        <!-- Contenido del contenedor... -->
        <div class="mb-3">
             <label for="formGroupExampleInput" class="form-label text-white">Nombre :</label>
             <input type="text" class="form-control w-100 texto-negro" id="nombre" name="nombre" placeholder="nombre" value="">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput2" class="form-label text-white">Apellidos:</label>
            <input type="text" class="form-control w-100 texto-negro" id="apellidos" name="apellidos" placeholder="apellidos" value="">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text-white">Email:</label>
            <input type="text" class="form-control w-100 texto-negro" step="any" id="email" name="email" min="0" placeholder="email">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text-white">Dni:</label>
            <input type="text" class="form-control w-100 texto-negro" step="any" id="dni" name="dni" min="0" placeholder="dni">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text-white">Password:</label>
            <input type="password" class="form-control w-100 texto-negro" step="any" id="password" name="password" placeholder="password">
        </div>
        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text-white">Repite la password:</label>
            <input type="password" class="form-control w-100 texto-negro" step="any" id="passwordRepeat" placeholder="repite password">
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label text-white">Elige tu gimnasio:</label>
            <select class="form-select w-100" name="id_gimnasio">
                @foreach ($gimnasios as $g)
                    <option value="{{ $g->_id }}" >{{ $g->nombre }}</option>
                 @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label text-white">Elige tu membresía: </label>

            <select class="form-select w-100" name="id_membresia" id="membresia" value="vacio">
                <option disabled selected value=""> -- select an option -- </option>
                @foreach ($membresias as $m)
                    <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                @endforeach

            </select>
        </div>

        <div class="mb-3" id="precios-div" style="display: none;">
            <label for="precio" class="form-label text-white">Elige el precio y período : </label>
            <select class="form-select w-100" name="plan_id" id="plan">

            </select>
        </div>

    <button type="submit" class="btn btn-light">Registrarse</button>
</div>
</form>


<script>

    const selectMembresia = document.getElementById('membresia');
    const preciosDiv = document.getElementById('precios-div');
    const selectPrecios = document.getElementById('plan');
    const planes = {!! json_encode($planes) !!};
    selectMembresia.selectedIndex = 0; // Hacer que la opcion marcada por defecto esté en blanco

    // -------- Validar si el dni o email son correctos ----------

    document.querySelector('form').addEventListener('submit', function (event) {

        var dni = document.getElementById('dni').value;
        var email = document.getElementById('email').value;
        var password = document.getElementById('password').value;
        var passwordRepeat = document.getElementById('passwordRepeat').value;
        var passwordCoincide = (password == passwordRepeat);
        var nombre = document.getElementById("nombre");
        var apellidos = document.getElementById("apellidos");
        var nombreVacio = (nombre.value == "" || apellidos.value == "");

        var regex = /^[XYZ0-9][0-9]{7}[TRWAGMYFPDXBNJZSQVHLCKE]$/i;
        var regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        var mensajeMostrado = "";


        if (!regex.test(dni) || !regexEmail.test(email) || !passwordCoincide || selectMembresia.value == "" || nombreVacio ) {

            if(!regex.test(dni) ){mensajeMostrado += "El formato del documento de identidad no es valido"}
            else if(!regexEmail.test(email) ){mensajeMostrado = "El formato del email no es valido"}
            else if(!passwordCoincide){mensajeMostrado = "La contraseña debe coincidir en ambos campos"}
            else if(selectMembresia.value == ""){mensajeMostrado = "debes seleccionar un plan"}
            else if(nombreVacio){mensajeMostrado = "debes rellenar tus nombres y apellidos"}

            event.preventDefault(); // Evita que el formulario se envíe si la validación falla
            mostrarMensaje(mensajeMostrado);
        }
    });


    // --------  Mostrar precios segun el plan que se elja --------



    selectMembresia.addEventListener('change', function() {
        const selectedMembresiaName = selectMembresia.options[selectMembresia.selectedIndex].text.toLowerCase();

        if (selectedMembresiaName) {
            preciosDiv.style.display = 'block';

            selectPrecios.innerHTML = '';

            planes.forEach(plan => {
                const planName = plan.name.toLowerCase();
                if (planName.includes(selectedMembresiaName)) {
                    const option = document.createElement('option');
                    option.textContent = `${plan.name} : ${plan.price} €`;
                    option.value = plan.id;
                    selectPrecios.appendChild(option);
                }
            });
        } else {
            preciosDiv.style.display = 'none';
        }
    });



    function mostrarMensaje( mensajeMostrado){


        let mensaje = document.createElement("p");
            mensaje.innerHTML = mensajeMostrado;
            mensaje.style.backgroundColor = 'red';
            mensaje.style.height = '100%';
            mensaje.style.width = '100%';
            mensaje.classList.add("centrar")
            let mensajes = document.getElementById("mensajes");
            mensajes.appendChild(mensaje);
            setTimeout(() => {
                mensajes.innerHTML = "";
            }, 3000);

    }
</script>

@endsection
