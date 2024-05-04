@extends('layouts.plantilla')

@section('middle')


<form action = "{{ route('payment') }}" method="get" >
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
            <label for="categoria" class="form-label text-white">Elige tu gimnasio:</label>
            <select class="form-select w-100" name="id_gimnasio">
                @foreach ($gimnasios as $g)
                    <option value="{{ $g->_id }}" >{{ $g->nombre }}</option>
                 @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label text-white">Elige tu membresía: </label>
            <select class="form-select w-100" name="id_gimnasio" id="membresia">
                @foreach ($membresias as $m)
                    <option value="{{ $m->_id }}">{{ $m->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3" id="precios-div" style="display: none;">
            <label for="precio" class="form-label text-white">Elige el precio y período : </label>
            <select class="form-select w-100" name="precio" id="precios">

            </select>
        </div>

    <button type="submit" class="btn btn-light">Registrarse</button>
</div>
</form>


{{-- Cambiar los precios mostrados:  --}}
<script>

    const selectMembresia = document.getElementById('membresia');

    const preciosDiv = document.getElementById('precios-div');

    const selectPrecios = document.getElementById('precios');


    selectMembresia.addEventListener('change', function() {

        const selectedMembresiaId = selectMembresia.value;


        if (selectedMembresiaId) {

            preciosDiv.style.display = 'block';


            const selectedMembresia = {!! json_encode($membresias) !!}.find(m => m._id === selectedMembresiaId);

            selectPrecios.innerHTML = '';

            // Seleccionar el periodo y precios :
            selectedMembresia.periodos_meses.forEach(meses => {

                let valorTotal = selectedMembresia.precio * meses;
                let option = document.createElement('option');
                option.textContent = meses+ " meses : " +valorTotal + " €";
                option.value = valorTotal+"|"+meses ;
                selectPrecios.appendChild(option);

            });


        } else {
            preciosDiv.style.display = 'none';
        }
    });
</script>

@endsection
