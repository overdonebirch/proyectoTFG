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

        Clase::create([


            "nombre" => "bike fisico",
            "tipo_clase" => [
                [
                    "tipo_clase_id" => "662e7289174ba290ea075ce2",
                    "nombre" => "Cardio",
                    "descripcion" => "Quemar calorias como debe ser",
                ]
            ],
            "gimnasios" => [
                [
                    "gimnasio_id" => $gimnasioParlaId ,
                    "horario" => [
                        ["dia" => "lunes", "horaInicio" => "9:00", "horaFin" => "10:00"],
                        ["dia" => "miercoles", "horaInicio" => "11:00", "horaFin" => "12:00"],
                        ["dia" => "viernes", "horaInicio" => "18:00", "horaFin" => "19:00"]
                    ]
                ]
            ]
        ]);




        Clase::create([
            "nombre" => "bike virtual",
            "tipoClase" => [
                [
                    "tipo_clase_id" => "662e7289174ba290ea075ce2",
                    "nombre" => "Cardio",
                    "descripcion" => "Quemar calorias como debe ser",
                ]
            ],
            "gimnasios" => [
                [
                    "gimnasio_id" => $gimnasioLeganesId,
                    "horario" => [
                        ["dia" => "martes", "horaInicio" => "15:00", "horaFin" => "16:00"],
                        ["dia" => "jueves", "horaInicio" => "11:00", "horaFin" => "12:00"]
                    ]
                ]
            ]
        ]);
    }
}
