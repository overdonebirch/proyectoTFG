<?php

namespace Database\Seeders;

use App\Models\Reserva;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $date = \Carbon\Carbon::now()->endOfMonth();
         Reserva::create([

            "fecha" => $date->toDateString(),
            "hora_inicio" =>  $date->copy()->setHour(11)->setMinute(0)->toTimeString(),
            "hora_fin" => $date->copy()->setHour(12)->setMinute(0)->toTimeString(),

         ]);


    }
}
