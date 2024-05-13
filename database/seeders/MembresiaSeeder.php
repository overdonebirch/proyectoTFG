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
            'invitar_amigo' => false,
            'acceso_clases_basicas' => true,
            'acceso_clases_premium' => false
        ]);

        Membresia::create([
            'nombre' => "Premium",
            'invitar_amigo' => true,
            'acceso_clases_basicas' => true,
            'acceso_clases_premium' => true
        ]);
    }
}
