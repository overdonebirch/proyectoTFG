<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class TipoClase extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    public function clases()
    {
        return $this->hasMany(Clase::class, 'tipoClase');
    }
}
