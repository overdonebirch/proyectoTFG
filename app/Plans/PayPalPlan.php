<?php

namespace App\Plans;

use App\Plans\Plans;
use Exception;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PayPalPlan implements Plans
{
    protected $provider;

    public function __construct()
    {
        $this->provider = new PayPalClient;

        $this->provider->setApiCredentials(config('paypal'));
        $this->provider->setCurrency('EUR');
        $this->provider->getAccessToken();
        $this->provider->showTotals(config('paypal.total_required'));


    }

    public function create(string $product_id, string $frecuency){


        $plan = $this->provider->createPlan([

            "product_id" => $product_id,
            "name" => "Plan Mensual Suscripcion Basica",
            "description" => "Plan Mensual Suscripcion Basica ",
            "status" => "ACTIVE",
            "billing_cycles" => [
                [
                    "frequency" => [
                        "interval_unit" => $frecuency,
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
    public function deactivate(string $plan_id = null){

        $this->provider->deactivatePlan($plan_id);

    }
    public function getDetails(string $plan_id = null){

        return $this->provider->showPlanDetails($plan_id);

    }
    public function listPlans(){
        return $this->provider->listPlans();
    }

    public function getPlan(string $name = null ){

        $plans = $this->provider->listPlans();

        foreach ($plans['plans'] as $plan) {

            if (array_key_exists('name', $plan)) {

                if($this->compareStrings($plan['name'], $name)){

                    return $plan;

                }

            } else {

                return "no se encontró el plan";

            }
        }
    }


    private function compareStrings($str1, $str2) {

        $str1 = trim(strtolower($str1));
        $str2 = trim(strtolower($str2));

        // Remover acentos usando la función de transliteración de PHP
        $str1 = iconv('UTF-8', 'ASCII//TRANSLIT', $str1);
        $str2 = iconv('UTF-8', 'ASCII//TRANSLIT', $str2);

        // Comparar las cadenas ignorando mayúsculas, acentos y espacios en blanco
        return strcasecmp($str1, $str2) === 0;
    }
}
