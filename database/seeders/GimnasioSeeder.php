<?php

namespace Database\Seeders;

use App\Models\Clase;
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

        $bikeFisico = Clase::where("nombre","bike fisico")->first()->toArray();
        $bikeVirtual = Clase::where("nombre","bike virtual")->first()->toArray();
        $yoga = Clase::where("nombre","Yoga")->first()->toArray();
        $crossfit = Clase::where("nombre","Crossfit")->first()->toArray();

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
                ],
            'clases' => [

                [
                    "clase" => $bikeFisico,
                    "horario" => [
                        ["dia" => 1, "horaInicio" => 9, "horaFin" => 10],
                        ["dia" => 3, "horaInicio" => 11, "horaFin" => 12],
                        ["dia" => 5, "horaInicio" => 18, "horaFin" => 19]
                    ],
                    "vacantes" => 30
                ],

                [
                    "clase" => $bikeVirtual,
                    "horario" => [
                        ["dia" => 1, "horaInicio" => 12, "horaFin" => 13],
                        ["dia" => 2, "horaInicio" => 11, "horaFin" => 12],
                        ["dia" => 3, "horaInicio" => 18, "horaFin" => 19]
                    ],
                    "vacantes" => 30
                ],

                [
                    "clase" => $crossfit,
                    "horario" => [
                        ["dia" => 4, "horaInicio" => 16, "horaFin" => 17],
                        ["dia" => 6, "horaInicio" => 10, "horaFin" => 11],

                    ],
                    "vacantes" => 30
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
            ],

            'clases' => [

                [
                    "clase" => $bikeFisico,
                    "horario" => [
                        ["dia" => 1, "horaInicio" => 9, "horaFin" => 10],
                        ["dia" => 3, "horaInicio" => 11, "horaFin" => 12],
                        ["dia" => 5, "horaInicio" => 18, "horaFin" => 19]
                    ],
                    "vacantes" => 30
                ],

                [
                    "clase" => $bikeVirtual,
                    "horario" => [
                        ["dia" => 1, "horaInicio" => 12, "horaFin" => 13],
                        ["dia" => 2, "horaInicio" => 11, "horaFin" => 12],
                        ["dia" => 3, "horaInicio" => 18, "horaFin" => 19]
                    ],
                    "vacantes" => 30
                ],

                [
                    "clase" => $yoga,
                    "horario" => [
                        ["dia" => 5, "horaInicio" => 16, "horaFin" => 17],
                        ["dia" => 6, "horaInicio" => 10, "horaFin" => 11],

                    ],
                    "vacantes" => 30
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
            ],

            'clases' => [

                [
                    "clase" => $bikeFisico,
                    "horario" => [
                        ["dia" => 1, "horaInicio" => 9, "horaFin" => 10],
                        ["dia" => 3, "horaInicio" => 11, "horaFin" => 12],
                        ["dia" => 5, "horaInicio" => 18, "horaFin" => 19]
                    ],
                    "vacantes" => 30
                ],

                [
                    "clase" => $bikeVirtual,
                    "horario" => [
                        ["dia" => 1, "horaInicio" => 12, "horaFin" => 13],
                        ["dia" => 2, "horaInicio" => 11, "horaFin" => 12],
                        ["dia" => 3, "horaInicio" => 18, "horaFin" => 19]
                    ],
                    "vacantes" => 30
                ],

                [
                    "clase" => $yoga,
                    "horario" => [
                        ["dia" => 5, "horaInicio" => 16, "horaFin" => 17],
                        ["dia" => 6, "horaInicio" => 10, "horaFin" => 11],

                    ],
                    "vacantes" => 30
                ]
            ]




        ]);

    }
}
