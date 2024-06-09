<section class="container-fluid d-flex justify-content-center align-items-center mt-5" style="height: 100vh;">
    <div class="row panelOpciones d-flex flex-column justify-content-evenly">
        <div class="col-md-12 d-flex mt-5 justify-content-center ">
            <a href="{{route ('editUser')}}"type="button" class="btn boton justify-content-center textoBoton color-secundario">Editar Usuario</a>
        </div>


        <div class="col-md-12 d-flex  justify-content-center ">
            <form method="GET" action="{{route('editUser')}}">
                @csrf
                <button type="submit" name="eliminarUser" class="btn boton justify-content-center textoBoton color-negro"> Eliminar usuario </button>
            </form>
        </div>
    </div>
</section>
