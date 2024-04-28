<?php

namespace Database\Seeders;

use App\Models\Membresia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembresiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Membresia::create([
            'nombre' => "Basica",
            'precio' => 20.0,
            'periodos_meses' => [1,12],
            'invitar_amigo' => false,
            'acceso_clases_basicas' => true,
            'acceso_clases_premium' => false
        ]);

        Membresia::create([
            'nombre' => "Premium",
            'periodos_meses' => [1,12],
            'precio' => 30.0,
            'invitar_amigo' => true,
            'acceso_clases_basicas' => true,
            'acceso_clases_premium' => true
        ]);
    }
}
