<?php

namespace App\Subscriptions;

use App\Subscriptions\Subscriptions;
use Exception;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PayPalSubscription implements Subscriptions
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

    public function create(string $plan_id, int $coupon_user_id, string $method, float $amount = 0,Request $request){

        $paypalPlanId = $plan_id;

        $data = [
            'plan_id' => $paypalPlanId,
            'quantity' => '1',
            'subscriber' => [
                'name' => [
                    'given_name' => $request->nombre,
                    'surname' => '',
                ],
                'email_address' => $request->email,
            ],
            'application_context' => [
                'brand_name' => env('PAYPAL_BRAND_NAME'),
                'locale' => 'es-ES',
                'shipping_preference' => 'NO_SHIPPING',
                'user_action' => 'SUBSCRIBE_NOW',
                'payment_method' => [
                    'payer_selected' => 'PAYPAL',
                    'payee_preferred' => 'IMMEDIATE_PAYMENT_REQUIRED',
                ],
                'return_url' => route('success'),
                'cancel_url' => route('cancel'),
            ],
        ];

        // Include additional data for subscription with a coupon
        if ($coupon_user_id != 0) {
            $data['plan'] = [
                'billing_cycles' => [
                    [
                        'sequence' => 1,
                        'total_cycles' => 1,
                        'pricing_scheme' => [
                            'fixed_price' => [
                                'value' => $amount, // discounted amount
                                'currency_code' => 'EUR',
                            ],
                        ],
                    ],
                ],
            ];
        }

        $response = $this->provider->createSubscription($data);

        if (isset($response['id']) && $response['id'] != null) {
            // Redirect to PayPal approval URL
            foreach ($response['links'] as $link) {
                if ($link['rel'] == 'approve') {

                    $request->session()->put('nombre', $request->nombre);
                    $request->session()->put('apellidos', $request->apellidos);
                    $request->session()->put('email', $request->email);
                    $request->session()->put('dni', $request->dni);
                    $request->session()->put('password', Hash::make($request->password));
                    $request->session()->put('id_gimnasio', $request->id_gimnasio);
                    $request->session()->put('id_membresia', $request->id_membresia);


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
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }

    }

    public function cancel(string $subscription_id = null){

        try {
           $this->provider->cancelSubscription($subscription_id, "no longer using");
        } catch (Exception $e) {
            $error = "Something went wrong." . $e->getMessage();
            return "no se cancelo";
        }


    }

    public function pause(){

    }

    public function resume(){

    }


}


