<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Clase extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'nombre'
    ];

    public function gimnasios()
    {
        return $this->belongsTo(Gimnasio::class);
    }

    public function tipoClase()
    {
        return $this->belongsTo(TipoClase::class, 'tipoClase');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_clase', '_id');
    }

}
