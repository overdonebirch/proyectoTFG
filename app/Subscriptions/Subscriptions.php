<?php
namespace App\Subscriptions;
use Illuminate\Http\Request;

interface Subscriptions
{
    public function create(string $plan_id, int $coupon_user_id, string $method, float $amount = 0,Request $request);
    public function cancel(string $subscription_id = null);
    public function pause();
    public function resume();
}
