<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Reserva extends Model
{
    use HasFactory;
    protected $connection = 'mongodb';

    protected $fillable = [
        "id_usuario",
        "id_clase",
        "fecha",
        "hora_inicio",
        "hora_fin"

    ];

    public function gimnasio()
    {
        return $this->belongsTo(Gimnasio::class, 'id_gimnasio', '_id');
    }

    public function clase()
    {
        return $this->belongsTo(Clase::class, 'id_clase', '_id');
    }
}
