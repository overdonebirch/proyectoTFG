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
            'costo_unico' => 6,
            'descripcion' => 'Quemar calorias como debe ser',
            'clase_premium' => false
        ]);

        TipoClase::create([
            'nombre' => "Relajacion",
            'costo_unico' => 6,
            'descripcion' => 'Para quitar el estrés',
            'clase_premium' => false
        ]);

        TipoClase::create([
            'nombre' => "Tonificar",
            'costo_unico' => 8,
            'descripcion' => 'Ganar Masa Muscular',
            'clase_premium' => true
        ]);

        TipoClase::create([
            'nombre' => "Baile",
            'costo_unico' => 8,
            'descripcion' => 'Aquiere ritmo mientras quemas calorias',
            'clase_premium' => true
        ]);
    }
}
