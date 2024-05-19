@extends('layouts.plantilla')

@section('middle')


<form action = "{{ route('login') }}" method="POST" >
    @csrf
    <div class="container px-4 px-lg-5 color-form rounded p-4 mt-5" style="width: 30%;">

        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text-white">Email:</label>
            <input type="email" class="form-control w-100 texto-negro" step="any" id="formGroupExampleInput" name="email" min="0" placeholder="email">
        </div>

        <div class="mb-3">
            <label for="formGroupExampleInput" class="form-label text-white">Password:</label>
            <input type="password" class="form-control w-100 texto-negro" step="any" id="formGroupExampleInput" name="password" min="0" placeholder="password">
        </div>

    <button type="submit" class="btn btn-light">Logarse</button>

</div>
</form>

@endsection
