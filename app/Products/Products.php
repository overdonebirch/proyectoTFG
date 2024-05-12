<?php
namespace App\Products;
use Illuminate\Http\Request;

interface Products
{
    public function create(string $name, string $description, string $type = "SERVICE", string $category = "SOFTWARE");
    public function update(string $product_id = null, string $name = null, string $description = null );
    public function listProducts();
    public function getDetails(string $product_id = null);
    public function getProduct(string $name = null);
}
