<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Srmklive\PayPal\Services\PayPal as PayPalClient;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $product = Product::create([
            "id" => "XXCD1234QWER65755",
            "name" =>"Suscripción Básica Mensual",
            "description"=>"Suscripción Básica Mensual",
            "type"=>"SERVICE",
            "category"=>"SOFTWARE",
            "image_url"=> "https://epic-top-kodiak.ngrok-free.app/assets/img/maquinas.jpg",
            "home_url"=>  "https://epic-top-kodiak.ngrok-free.app/inicio"
        ]);

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->setCurrency('EUR');
        $provider->getAccessToken();

        $provider->createProduct([
            "id" => $product->id,
            "name" => $product->name,
            "description" => $product->description,
            "type" => $product->type,
            "category" => $product->category,
            "image_url" => $product->image_url,
            "home_url" => $product->home_url
        ]);
    }
}
