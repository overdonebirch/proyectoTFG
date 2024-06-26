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

    public function solicitarDniReserva(){
        return view('solicitarDniReserva');
    }
    public function reservasUsuario(Request $request){


        $user = Auth::user();
        $dni = null;

        if($user){
            $dni = $user->dni;
        }
        else{
            $dni = $request->dniReserva;
        }



        $reservas = Reserva::with(['gimnasio', 'clase'])
                           ->where('dni_usuario', $dni)
                           ->get();


        if ($reservas->isEmpty()) {

            if(Auth::user()){
                return redirect('perfil')->with("success", "Se han eliminado todas las reservas");
            }
            else{
                return redirect('/')->with("error", "No existen reservas de ese usuario");
            }

        }
        return view('reservasUsuario', compact('reservas'));

    }


    public function create(Request $request, Clase $clase, String $fecha, String $horaInicio, String $horaFin,Gimnasio $gimnasio){

        $user = Auth::user();
        $dniUsuario = $user->dni;

        $reservationsCount = Reserva::where('id_clase', $clase->_id)->where('fecha', $fecha)->where('hora_inicio',$horaInicio)->where('hora_fin',$horaFin)->count();
        $vacantes = $this->getVacantes($clase->_id,$gimnasio);

        $vacantesDisponibles = $vacantes - $reservationsCount;

        if( $vacantesDisponibles <= 0) {
            return redirect()->back()->with("error","Se han acabado las vacantes para esta clase");
        }

        return view("reservarClase",compact("clase","fecha","horaInicio","horaFin","gimnasio","dniUsuario","vacantesDisponibles"));

    }

    public function store(Request $request, Clase $clase, String $fecha, String $horaInicio, String $horaFin,Gimnasio $gimnasio,String $dniUsuario){


        $reserva = new Reserva();

        $reserva->dni_usuario = strtoupper($dniUsuario);
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


        return redirect('/')->with("success","clase reservada correctamente");


    }
    public function destroy(Reserva $reserva){
        $reserva->delete();
        return redirect()->back()->with('success', 'Reserva eliminada');
    }

    public function reservarNoUsuario(Request $request, Clase $clase, String $fecha, String $horaInicio, String $horaFin,Gimnasio $gimnasio){

        $reservationsCount = Reserva::where('id_clase', $clase->_id)->where('fecha', $fecha)->where('hora_inicio',$horaInicio)->where('hora_fin',$horaFin)->count();
        $vacantes = $this->getVacantes($clase->_id,$gimnasio);

        $vacantesDisponibles = $vacantes - $reservationsCount;

        if( $vacantesDisponibles <= 0) {
            return redirect()->back()->with("error","Se han acabado las vacantes para esta clase");
        }

        $precio = $clase->tipo_clase["costo_unico"];
        return view("reservaClaseNoUsuario",compact("clase","fecha","horaInicio","horaFin","gimnasio","precio","vacantesDisponibles"));

    }

    public function verificarReservaNoUsuario(Request $request)
    {
        $dni = strtoupper($request->input('dni_usuario'));
        $idClase = $request->input('id_clase');
        $fecha = $request->input('fecha');
        $horaInicio = $request->input('horaInicio');
        $horaFin = $request->input('horaFin');
        $idGimnasio = $request->input('id_gimnasio');

        // Verificar si la reserva ya existe
        $reservaExistente = Reserva::where('dni_usuario', $dni)
            ->where('id_clase', $idClase)
            ->where('fecha', $fecha)
            ->where('hora_inicio', $horaInicio)
            ->where('hora_fin', $horaFin)
            ->where('id_gimnasio', $idGimnasio)
            ->first();

        if ($reservaExistente) {
            return redirect()->back()->with("error","ya existe una reserva con los mismos datos");
        }

        // Redirigir a PayPal
        return $this->redirectBooking($request);
    }

    private function redirectBooking(Request $request)
    {

        // Crear un formulario oculto con los datos y enviarlo automáticamente usando JavaScript
        $params = $request->all();
        return response()->view('redirect.redirectBooking', compact('params'));
    }

    public function redirectBookingToStore(Request $request){

        $route = route('reservar', ['clase' => $request->session()->get('id_clase'), 'fecha' => $request->session()->get('fecha'), 'horaInicio' => $request->session()->get('horaInicio'),
        'horaFin' =>  $request->session()->get('horaFin'), 'gimnasio' => $request->session()->get('id_gimnasio'), "dniUsuario" => $request->session()->get('dni_usuario')]);


        return view('redirect.redirectBookingToStore', compact('route'));
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
