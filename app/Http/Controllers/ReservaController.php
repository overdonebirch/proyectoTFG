<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Gimnasio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;

use function PHPUnit\Framework\isEmpty;

class ReservaController extends Controller
{

    public function index()
    {
    }

    public function create(Request $request, Clase $clase, String $fecha, String $horaInicio, String $horaFin,Gimnasio $gimnasio)
    {
        $dni = "*";

        $user = Auth::user();

        if ($user) {

            $dni = $user->dni;

        }

        return view("reservarClase",compact("clase","fecha","horaInicio","horaFin","gimnasio","dni"));

    }

    public function store(Request $request, Clase $clase, String $fecha, String $horaInicio, String $horaFin,Gimnasio $gimnasio,String $dniUsuario)
    {



    }


}
