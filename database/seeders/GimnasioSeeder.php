<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gimnasio;

class GimnasioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Gimnasio::create([
            'nombre' => "Vitality Parla",
            'direccion' => 'Calle Estrella Polar 5',
            'horaApertura' => '08:00',
            'horaCierre' => '23:00',
        ]);
        Gimnasio::create([
            'nombre' => "Vitality Leganes",
            'direccion' => 'Calle Juan de La Cierva, 5',
            'horaApertura' => '08:00',
            'horaCierre' => '23:00',
        ]);


    }
}
