<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Subscriptions\PayPalSubscriptions;
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


        $paypalSub = new PayPalSubscriptions();

        // return $paypalSub->create("P-76V37557B4729941RMY3F57Y",0,"null",0,$request);

        return $paypalSub->cancel("I-5E6UT6REK1T6");

    }



    public function buscarPlan($provider,$nombre){

        $planes = $this->listPlans($provider);
        foreach ($planes['plans'] as $plan) {

            if (array_key_exists('name', $plan)) {

                if($plan['name'] == $nombre){

                    return $plan['name'];

                }

            } else {

                echo "El producto no tiene un nombre definido. <br>";

            }
        }


    }


    public function buscarProducto($provider,$nombre){

        $productos = $this->listProducts($provider);
        foreach ($productos['products'] as $producto) {

            if (array_key_exists('name', $producto)) {

                if($this->compararStrings($producto['name'],$nombre)){
                    return $producto['id'];
                }

            } else {

               return null;

            }
        }


    }

    public function listProducts($provider){
        return $provider->listProducts();

    }

    public function listPlans($provider){
        return $provider->listPlans();
    }




    public function createPlan($provider,$product_id){


        $plan = $provider->createPlan([

            "product_id" => $product_id,
            "name" => "Plan Mensual Suscripcion Basica",
            "description" => "Plan Mensual Suscripcion Basica ",
            "status" => "ACTIVE",
            "billing_cycles" => [
                [
                    "frequency" => [
                        "interval_unit" => "MONTH",
                        "interval_count" => 1
                    ],
                    "tenure_type" => "REGULAR",
                    "sequence" => 1,
                    "total_cycles" => 1,
                    "pricing_scheme" => [
                        "fixed_price" => [
                            "value" => 20,
                            "currency_code" => "EUR"
                        ]
                    ]
                ],
            ],
            "payment_preferences" => [
                "auto_bill_outstanding" => true,
                "setup_fee_failure_action" => "CANCEL",
                "payment_failure_threshold" => 1
            ]
        ]);

        return $plan;

    }


    public function success(Request $request){

        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $provider->getAccessToken();

        $nombre = $request->session()->get('nombre');
        $email = $request->session()->get('email');

        return $nombre;

        // $response = $provider->listSubscriptionTransactions($request->token, '2018-01-21T07:50:20.940Z', '2018-08-22T07:50:20.940Z');

        // dd($response);

    }

    public function cancel(){

        return redirect()->route('inicio')->with("error","se canceló el proceso de subscripción");

    }

    private function compararStrings($str1, $str2) {

        $str1 = trim(strtolower($str1));
        $str2 = trim(strtolower($str2));

        // Remover acentos usando la función de transliteración de PHP
        $str1 = iconv('UTF-8', 'ASCII//TRANSLIT', $str1);
        $str2 = iconv('UTF-8', 'ASCII//TRANSLIT', $str2);

        // Comparar las cadenas ignorando mayúsculas, acentos y espacios en blanco
        return strcasecmp($str1, $str2) === 0;
    }
}
