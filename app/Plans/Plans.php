<?php
namespace App\Plans;
use Illuminate\Http\Request;

interface Plans
{
    public function create(string $name, string $product_id, string $frecuency, float $price);
    public function deactivate(string $plan_id = null);
    public function getDetails(string $plan_id = null);
    public function listPlans();

    public function getPlan(string $name = null );
}
