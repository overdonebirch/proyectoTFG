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
        'direccion',
        'horarios',
        'clases',
    ];

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_gimnasio', '_id');
    }

    public function clases()
    {
        return $this->embedsMany(Clase::class, 'clases');
    }



}
