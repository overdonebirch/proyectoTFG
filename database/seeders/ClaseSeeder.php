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

        ]);



        Clase::create([


            "nombre" => "Yoga",
            "tipo_clase" => $tipoClaseRel,

        ]);




        Clase::create([
            "nombre" => "bike virtual",
            "tipo_clase" => $tipoClaseCar,
        ]);
    }
}
