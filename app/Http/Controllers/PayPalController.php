<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Reserva;
use App\Models\Suscripcion;
use App\Models\User;
use App\Subscriptions\PayPalSubscription;
use App\Plans\PayPalPlan;
use App\Products\PayPalProduct;
use App\Bookings\PayPalBooking;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Carbon\Carbon;
use Exception;

class PayPalController extends Controller
{
    public function payment(Request $request){

        $usuarioDni = User::where("dni",strtoupper($request->dni))->first();
        $usuarioEmail = User::where("email",strtolower($request->email))->first();

        if($usuarioDni != null){

            return redirect()->back()->with("error", "El dni ya está registrado en el sistema");
        }
        else if($usuarioEmail != null){
            return redirect()->back()->with("error", "El email ya está registrado en el sistema");
        }


        $plan_id = $request->plan_id;
        return $this->createSuscription($plan_id,$request);


    }

    public function bookingPayment(Request $request){


        $booking = new PayPalBooking();

        return $booking->createOrder($request);


    }

    public function bookingSuccess(Request $request){

        return redirect(route('reservar', ['clase' => $request->session()->get('id_clase'), 'fecha' => $request->session()->get('fecha'), 'horaInicio' => $request->session()->get('horaInicio'),
        'horaFin' =>  $request->session()->get('horaFin'), 'gimnasio' => $request->session()->get('id_gimnasio'), "dniUsuario" => $request->session()->get('dni_usuario')]));

    }
    public function createSuscription($plan_id,$request){

       $paypalSub = new PayPalSubscription();
       return $paypalSub->create($plan_id,0,"",0,$request);
    }


    public function listPlans(){

       $plan = new PayPalPlan();
       return $plan->listPlans();

    }


    public function createPlan($name, $product_id,$frecuency,$price){

        $plan = new PayPalPlan();
        $planCreado = $plan->create($name,$product_id,$frecuency,$price); // La variable planCreado se utiliza para obtener todos los datos del plan de paypal, pero solo utilizaremos el campo name e id

        $plan = new Plan();

        $plan->name = $planCreado["name"];
        $plan->id = $planCreado["id"];
        $plan->price= $price;

        $plan->save();

        return $plan;

    }

    public function getPlan($name){

        $plan = new PayPalPlan();
        return $plan->getPlan($name);

    }

    public function createProduct($name,$description){

        $product = new PayPalProduct();
        $productoCreado = $product->create($name,$description);

        $product = new Product();

        $product->id = $productoCreado["id"];
        $product->name = $productoCreado["name"];
        $product->description = $productoCreado["description"];

        $product->save();


        return $product;

    }

    public function getProduct($name){

        $product = new PayPalProduct();
        return $product->getProduct($name);


    }

    public function listProducts(){

        $product = new PayPalProduct();
        return $product->listProducts();

    }



    public function success(Request $request){


        $id_membresia = $request->session()->get('id_membresia');
        $membresia = Membresia::where("_id",$id_membresia)->first();
        $fecha_actual = Carbon::today()->toDateString();

        $user = User::create([

            'nombre' => $request->session()->get('nombre'),
            'apellidos' => $request->session()->get('apellidos'),
            'email' => strtolower($request->session()->get('email')),
            'dni' => strtoupper($request->session()->get('dni')),
            'password' => $request->session()->get('password'),
            'id_gimnasio' => $request->session()->get('id_gimnasio'),
            'fecha_registro' => $fecha_actual,
            'membresia' => $membresia->toArray(),


        ]);

        Suscripcion::create([

            "id_cliente" => $user->_id,
            "id_suscripcion" => $request->subscription_id,

        ]);

        return redirect('inicio')->with('success', 'Usuario Registrado');


    }

    public function cancel(){

        return redirect()->route('inicio')->with("error","se canceló el proceso de subscripción");

    }

}
