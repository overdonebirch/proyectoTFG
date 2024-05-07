<?php
namespace App\Plans;
use Illuminate\Http\Request;

interface Plans
{
    public function create(string $product_id, string $frecuency);
    public function deactivate(string $plan_id = null);
    public function getDetails(string $plan_id = null);
    public function listPlans();

    public function getPlan(string $name = null );
}
