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
            'clase_premium' => false
        ]);

        TipoClase::create([
            'nombre' => "Relajacion",
            'descripcion' => 'Para quitar el estrés',
            'clase_premium' => false
        ]);

        TipoClase::create([
            'nombre' => "Tonificar",
            'descripcion' => 'Ganar Masa Muscular',
            'clase_premium' => true
        ]);

        TipoClase::create([
            'nombre' => "Baile",
            'descripcion' => 'Aquiere ritmo mientras quemas calorias',
            'clase_premium' => true
        ]);
    }
}
