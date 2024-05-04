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




            // if(isset($response['id']) && $response['id']!=null){
        //     foreach($response['links'] as $link){
        //         return redirect()->away($link['href']);
        //     }
        // }
        // else{
        //     return redirect()->route('cancel');
        // }
        $fecha_actual = Carbon::now()->addHours(1)->toIso8601String();
        $provider = new PayPalClient;

        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $provider->getAccessToken();
        $provider->showTotals(config('paypal.total_required'));
        $provider->getAccessToken();


        $paypalSub = new PayPalSubscriptions();
        return $paypalSub->create("P-07892534WR854431JMYZ5Q3I",0,"null",0,$request);


    }
    private function createPlan($provider){


        $plan = $provider->createPlan([

            "product_id" => "XXCD1234QWER65755",
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

        return "Se creó la suscricion para el mail : ". $request->email;

        // $response = $provider->listSubscriptionTransactions($request->token, '2018-01-21T07:50:20.940Z', '2018-08-22T07:50:20.940Z');

        // dd($response);

    }

    public function cancel(){

    }
}
