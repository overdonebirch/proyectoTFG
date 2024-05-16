<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Clase;
use App\Models\Gimnasio;
use App\Models\TipoClase;
// use MongoDB\Laravel\Eloquent\Casts\ObjectId;
use MongoDB\BSON\ObjectId;


class ClaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $tipoClaseId = TipoClase::pluck('_id')->first(); // Obtén el ID del TipoClase

        $claseCardioId = TipoClase::where('nombre', 'Cardio')->value('_id');
        $gimnasioParlaId = Gimnasio::where('nombre', 'Vitality Parla')->value('_id');
        $gimnasioLeganesId = Gimnasio::where('nombre', 'Vitality Leganes')->value('_id');

        $tipoClaseRel = TipoClase::where('nombre','Relajacion')->first()->toArray();
        $tipoClaseCar = TipoClase::where('nombre','Cardio')->first()->toArray();

        Clase::create([


            "nombre" => "bike fisico",
            "tipo_clase" => $tipoClaseCar,
            "gimnasios" => [
                [
                    "gimnasio_id" => $gimnasioParlaId ,
                    "horario" => [
                        ["dia" => 1, "horaInicio" => 9, "horaFin" => 10],
                        ["dia" => 3, "horaInicio" => 11, "horaFin" => 12],
                        ["dia" => 5, "horaInicio" => 18, "horaFin" => 19]
                    ]
                ]
            ]
        ]);



        Clase::create([


            "nombre" => "Yoga",
            "tipo_clase" => $tipoClaseRel,
            "gimnasios" => [
                [
                    "gimnasio_id" => $gimnasioParlaId ,
                    "horario" => [
                        ["dia" => 1, "horaInicio" => 11, "horaFin" => 11],
                        ["dia" => 3, "horaInicio" => 11, "horaFin" => 12],
                        ["dia" => 5, "horaInicio" => 18, "horaFin" => 19]
                    ]
                ]
            ]
        ]);




        Clase::create([
            "nombre" => "bike virtual",
            "tipoClase" => $tipoClaseCar,
            "gimnasios" => [
                [
                    "gimnasio_id" => $gimnasioLeganesId,
                    "horario" => [
                        ["dia" => 2, "horaInicio" => 15, "horaFin" => 16],
                        ["dia" => 4, "horaInicio" => 11, "horaFin" => 12]
                    ]
                ]
            ]
        ]);
    }
}
