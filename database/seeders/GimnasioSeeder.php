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
            'horarios' => [
                'lunes_a_viernes' => [
                    'apertura' => '8:00',
                    'cierre' => '23:00'
                ],
                'sabados' => [
                    'apertura' => '9:00',
                    'cierre' => '22:00'
                ],
                'domingos_y_festivos' => [
                    'apertura' => '9:00',
                    'cierre' => '14:00'
                ]
            ]

        ]);
        Gimnasio::create([
            'nombre' => "Vitality Leganes",
            'direccion' => 'Calle Madrid, 10',
            'horarios' => [
                'lunes_a_viernes' => [
                    'apertura' => '8:00',
                    'cierre' => '23:00'
                ],
                'sabados' => [
                    'apertura' => '9:00',
                    'cierre' => '22:00'
                ],
                'domingos_y_festivos' => [
                    'apertura' => '9:00',
                    'cierre' => '14:00'
                ]
            ]

        ]);

        Gimnasio::create([
            'nombre' => "Vitality Getafe",
            'direccion' => 'Calle Juan De La Cierva, 7',
            'horarios' => [
                'lunes_a_viernes' => [
                    'apertura' => '8:00',
                    'cierre' => '23:00'
                ],
                'sabados' => [
                    'apertura' => '9:00',
                    'cierre' => '22:00'
                ],
                'domingos_y_festivos' => [
                    'apertura' => '9:00',
                    'cierre' => '14:00'
                ]
            ]

        ]);

    }
}
