<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';


    protected $fillable = [
        'id',
        'name',
        'description',
        'type',
        'category',
        'image_url',
        'home_url'
    ];
}
