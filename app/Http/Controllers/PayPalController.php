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

        $request->session()->put('id_clase', $request->session()->get('id_clase'));
        $request->session()->put('fecha', $request->session()->get('fecha'));
        $request->session()->put('horaInicio',$request->session()->get('horaInicio'));
        $request->session()->put('horaFin', $request->session()->get('horaFin'));
        $request->session()->put('id_gimnasio', $request->session()->get('id_gimnasio'));
        $request->session()->put('dni_usuario', $request->session()->get('dni_usuario'));


        return redirect()->route('redirectBookingToStore');

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


        $request->session()->put('subscription_id', $request->subscription_id);
        return redirect()->route('redirectRegister');

    }

    public function cancel(){

        return redirect()->route('inicio')->with("error","se canceló el proceso de subscripción");

    }

}
