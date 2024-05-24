<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Gimnasio;
use App\Models\Reserva;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;


use function PHPUnit\Framework\isEmpty;

class ReservaController extends Controller
{

    public function index(){
    }

    public function create(Request $request, Clase $clase, String $fecha, String $horaInicio, String $horaFin,Gimnasio $gimnasio){

        $dni = "*";

        $user = Auth::user();


        if ($user) {

            $dni = $user->dni;

        }

        $reservationsCount = Reserva::where('id_clase', $clase->_id)->where('fecha', $fecha)->where('hora_inicio',$horaInicio)->where('hora_fin',$horaFin)->count();
        $vacantes = $this->getVacantes($clase->_id,$gimnasio);

        $vacantesDisponibles = $vacantes - $reservationsCount;

        if( $vacantesDisponibles <= 0) {
            return redirect()->back()->with("error","Se han acabado las vacantes para esta clase");
        }

        return view("reservarClase",compact("clase","fecha","horaInicio","horaFin","gimnasio","dni","vacantesDisponibles"));

    }

    public function store(Request $request, Clase $clase, String $fecha, String $horaInicio, String $horaFin,Gimnasio $gimnasio,String $dniUsuario){

        if($dniUsuario == "*"){
            return redirect(route('reservarNoUsuario', ['clase' => $clase->_id, 'fecha' => $fecha, 'horaInicio' => $horaInicio,'horaFin' => $horaFin, 'gimnasio' => $gimnasio->_id, "dniUsuario" => $dniUsuario]));
        }
        else {

            $reserva = new Reserva();

            $reserva->dni_usuario = $dniUsuario;
            $reserva->id_clase = $clase->_id;
            $reserva->id_gimnasio = $gimnasio->_id;
            $reserva->fecha = $fecha;
            $reserva->hora_inicio = $horaInicio;
            $reserva->hora_fin = $horaFin;

            try{
                $reserva->save();
            }
            catch(Exception  $e){
                return redirect('clases')->with("error", "Ya existe una reserva con los mismos datos");
            }


            return redirect('inicio')->with("success","clase reservada correctamente");
        }



    }

    public function reservarNoUsuario(Request $request, Clase $clase, String $fecha, String $horaInicio, String $horaFin,Gimnasio $gimnasio){

        $dni = "*";

        $reservationsCount = Reserva::where('id_clase', $clase->_id)->where('fecha', $fecha)
                            ->where('hora_inicio',$horaInicio)->where('hora_fin',$horaFin)->where("id_gimnasio",$gimnasio->_id)->count();
                            $precio = $clase->tipo_clase["costo_unico"];;

        return view("reservaClaseNoUsuario",compact("clase","fecha","horaInicio","horaFin","gimnasio","dni","precio","request"));

    }


    private function getVacantes( String $claseId, Gimnasio $gimnasio)
    {

        // Recorrer las clases del gimnasio
        foreach ($gimnasio->clases as $clase) {
            if ($clase['clase']['_id'] == $claseId) {
                return $clase['vacantes'];
            }
        }

        return response()->json(['message' => 'Clase no encontrada en este gimnasio'], 404);
    }

}
