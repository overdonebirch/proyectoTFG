<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BookingClassMiddleware
{
     /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();


        if($user){

            $gimnasio = $request->route('gimnasio');
            $clase = $request->route('clase');

            if ($gimnasio->_id!= $user->id_gimnasio) {

                return redirect()->back()->with("error","No estas inscrito en este gimnasio");

            }
            else if(!$user->membresia["acceso_clases_premium"] && $clase->tipo_clase["clase_premium"]){
                return redirect()->back()->with("error","Tu membresía no permite acceso a esta clase (se requiere membresía Premium)");
            }
        }
        else{
               // Si no hay un usuario logado, redirigir a la ruta reservarNoUsuario con los mismos parámetros
               return redirect()->route('reservarNoUsuario', [
                'clase' => $request->route('clase'),
                'fecha' => $request->route('fecha'),
                'horaInicio' => $request->route('horaInicio'),
                'horaFin' => $request->route('horaFin'),
                'gimnasio' => $request->route('gimnasio')
            ]);
        }

        return $next($request);



    }
}
