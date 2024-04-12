<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Gimnasio extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'nombre',
        'email',
        'dni',
        'password'
    ];




}
