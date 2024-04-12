<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoClase;

class TipoClaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        TipoClase::create([
            'nombre' => "Cardio",
            'descripcion' => 'Quemar calorias como debe ser',

        ]);

        TipoClase::create([
            'nombre' => "Relajacion",
            'descripcion' => 'Para quitar el estrés',

        ]);
    }
}
