<?php
namespace App\Bookings;
use Illuminate\Http\Request;

interface Bookings
{
    public function createOrder(Request $request);


}
