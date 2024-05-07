<?php

namespace App\Products;

use App\Products\Products;
use Exception;
use Illuminate\Support\Facades\Log;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PayPalProduct implements Products
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

    public function create(string $name, string $description, string $type = "SERVICE", string $category = "SOFTWARE"){


        $product = $this->provider->createProduct([
            "name" => $name,
            "description" => $description,
            "type" => $type,
            "category" => $category
          ]);

         return $product;

    }
    public function update(string $product_id = null, string $name = null, string $description = null ){

    }
    public function listProducts(){
        return $this->provider->listProducts();
    }

    public function getDetails(string $product_id = null){

        $product = $this->provider->showProductDetails($product_id);
    }

    public function getProduct(string $name = null){

        $productos = $this->provider->listProducts();

        foreach ($productos['products'] as $producto) {

            if (array_key_exists('name', $producto)) {

                if($this->compareStrings($producto['name'],$name)){
                    return $producto;
                }

            } else {

                return null;

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
