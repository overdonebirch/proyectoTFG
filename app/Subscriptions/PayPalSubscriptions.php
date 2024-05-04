<?php

namespace App\Subscriptions;

use App\Subscriptions\Subscriptions;
use Exception;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;

class PayPalSubscriptions implements Subscriptions
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


        return $request;
        $paypalPlanId = $plan_id;

        $data = [
            'plan_id' => $paypalPlanId,
            'quantity' => '1',
            'shipping_amount' => [
                'currency_code' => 'EUR',
                'value' => 0.00,
            ],
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
                    return redirect()->away($link['href']);
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


    }

    public function pause(){

    }

    public function resume(){

    }


}


