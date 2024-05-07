<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use App\Models\User;
use App\Subscriptions\PayPalSubscription;
use App\Plans\PayPalPlan;
use App\Products\PayPalProduct;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Carbon\Carbon;
use Exception;

class PayPalController extends Controller
{
    public function payment(Request $request){

        $fecha_actual = Carbon::now()->addHours(1)->toIso8601String();
        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $provider->getAccessToken();
        $provider->showTotals(config('paypal.total_required'));
        $provider->getAccessToken();

        return $this->getProductDetails("Suscripcion basica anual");
        // $paypalSub = new PayPalSubscription();
        // return $paypalSub->create("P-76V37557B4729941RMY3F57Y",0,"",0,$request);

    }



    public function listPlans(){

       $plan = new PayPalPlan();
       return $plan->listPlans();

    }


    public function createPlan($product_id,$frecuency){

        $plan = new PayPalPlan();
        $plan->create($product_id,$frecuency);

    }

    public function getPlan($name){

        $plan = new PayPalPlan();
        return $plan->getPlan($name);

    }

    public function createProduct($name,$description){

        $product = new PayPalProduct();
        return $product->create($name,$description);


    }

    public function getProduct($name){

        $product = new PayPalProduct();
        return $product->getProduct($name);


    }

    public function listProducts($provider){

        $product = new PayPalProduct();
        return $product->listProducts();

    }



    public function success(Request $request){


        $id_membresia = $request->session()->get('id_membresia');
        $membresia = Membresia::where("_id",$id_membresia)->first();

        User::create([

            'nombre' => $request->session()->get('nombre'),
            'apellidos' => $request->session()->get('apellidos'),
            'email' => $request->session()->get('email'),
            'dni' => $request->session()->get('dni'),
            'password' => $request->session()->get('password'),
            'id_gimnasio' => $request->session()->get('id_gimnasio'),
            'membresia' => $membresia->toArray(),


        ]);

        return redirect('inicio')->with('success', 'Usuario Registrado');


    }

    public function cancel(){

        return redirect()->route('inicio')->with("error","se canceló el proceso de subscripción");

    }

}
