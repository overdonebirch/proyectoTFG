<?php

namespace App\Bookings;

use App\Bookings\Bookings;
use Exception;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PayPalBooking implements Bookings{

    protected $provider;

    public function __construct(){

        $this->provider = new PayPalClient;

        $this->provider->setApiCredentials(config('paypal'));
        $this->provider->setCurrency('EUR');
        $this->provider->getAccessToken();
        $this->provider->showTotals(config('paypal.total_required'));
        $this->provider->getAccessToken();

    }

    public function createOrder(Request $request){


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

        $response = $this->provider->createOrder($data);



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

}
