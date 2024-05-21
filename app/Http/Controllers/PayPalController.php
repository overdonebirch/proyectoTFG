<?php

namespace App\Http\Controllers;

use App\Models\Membresia;
use App\Models\Plan;
use App\Models\Product;
use App\Models\Suscripcion;
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

        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $provider->getAccessToken();
        $provider->showTotals(config('paypal.total_required'));
        $provider->getAccessToken();

        $usuario = User::where("dni",$request->dni)->first();
        $email = User::where("email",$request->email)->first();

        if($usuario != null){
            return redirect()->back()->with("error", "El dni ya está registrado en el sistema");
        }
        else if($email != null){
            return redirect()->back()->with("error", "El email ya está registrado en el sistema");
        }

        $plan_id = $request->plan_id;
        return $this->createSuscription($plan_id,$request);


    }

    public function bookingPayment(Request $request){

        $route = route('reservar', ['clase' => $request->id_clase, 'fecha' => $request->fecha, 'horaInicio' => $request->horaInicio,
        'horaFin' =>  $request->horaFin, 'gimnasio' => $request->id_gimnasio, "dniUsuario" => $request->dni_usuario]);

        $data = [

            "intent" => "CAPTURE",
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "EUR",
                        "value" => $request->precio
                    ]
                ]
            ],
            "payment_source" => [
                "paypal" => [
                  "experience_context" => [
                    "payment_method_preference" => "IMMEDIATE_PAYMENT_REQUIRED",
                    "locale" => "es-ES",
                    "user_action" => "PAY_NOW",
                    "return_url" => $route,
                    "cancel_url" => route('cancel')
                  ]
                ]

            ]
        ];

        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $provider->getAccessToken();
        $provider->showTotals(config('paypal.total_required'));
        $provider->getAccessToken();

        $response = $provider->createOrder($data);


        if (isset($response['id']) && $response['id'] != null) {

            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'payer-action') {

                    $request->session()->put('id_clase', $request->id_clase);
                    $request->session()->put('fecha', $request->fecha);
                    $request->session()->put('horaInicio', $request->horaInicio);
                    $request->session()->put('horaFin', $request->horaFin);
                    $request->session()->put('dni_usuario', $request->dni_usuario);
                    $request->session()->put('id_gimnasio', $request->id_gimnasio);


                    return redirect()
                    ->away($link['href'])
                    ->withInput();

                }
            }

            return redirect()
                ->route('inicio')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('inicio')
                ->with('error', $response['message'] ?? 'Response id doesnt exist');
        }


    }

    public function bookingSuccess(Request $request){


        // $route = route('reservar', ['clase' => $request->session()->get('id_clase'), 'fecha' => $request->session()->get('fecha'), 'horaInicio' => $request->session()->get('horaInicio'),
        //                             'horaFin' =>  $request->session()->get('horaFin'), 'gimnasio' => $request->session()->get('id_gimnasio'), "dniUsuario" => $request->session()->get('dni_usuario')]);

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

        $user = User::create([

            'nombre' => $request->session()->get('nombre'),
            'apellidos' => $request->session()->get('apellidos'),
            'email' => $request->session()->get('email'),
            'dni' => $request->session()->get('dni'),
            'password' => $request->session()->get('password'),
            'id_gimnasio' => $request->session()->get('id_gimnasio'),
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
