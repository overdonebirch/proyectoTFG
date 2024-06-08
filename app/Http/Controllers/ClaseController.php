<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Gimnasio;
use App\Models\TipoClase;
use Illuminate\Http\Request;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){

        $gimnasios = Gimnasio::all();
        $clases = collect();
        $selectedGimnasio = null;
        $eventos = [];

        if ($request->has('gimnasio_id')) {
            $selectedGimnasio = Gimnasio::find($request->input('gimnasio_id'));
            if ($selectedGimnasio) {
                $clases = $selectedGimnasio->clases;

                $colorMapping = [
                    'Cardio' => '#BBFF04',
                    'Relajacion' => '#F7D1E2',
                    'Tonificar' => '#393D3C',
                    'Baile' => '#FF5D12',
                ];

                foreach ($clases as $clase) {
                    foreach ($clase['horario'] as $horario) {
                        $nombreClase = $clase['clase']['tipo_clase']['nombre'];
                        $firstDayOfMonth = \Carbon\Carbon::now()->startOfMonth();
                        $lastDayOfMonth = \Carbon\Carbon::now()->endOfMonth();
                        $dates = \Carbon\CarbonPeriod::create($firstDayOfMonth, $lastDayOfMonth);

                        $filteredDates = collect($dates)->filter(function ($date) use ($horario) {
                            return $date->dayOfWeek === $horario['dia'];
                        });

                        $color = $colorMapping[$nombreClase] ?? '#378006';

                        foreach ($filteredDates as $date) {
                            $startTime = $date->copy()->setHour($horario['horaInicio'])->setMinute(0);
                            $endTime = $date->copy()->setHour($horario['horaFin'])->setMinute(0);
                            $fecha = $date->toDateString();
                            $id_clase = $clase['clase']['_id'];
                            $id_gimnasio = $selectedGimnasio->_id;
                            $hora_inicio = $startTime->toTimeString();
                            $_hora_fin = $endTime->toTimeString();
                            $route = route('reservarClase', [
                                'clase' => $clase['clase']['_id'],
                                'fecha' => $fecha,
                                'horaInicio' => $hora_inicio,
                                'horaFin' => $_hora_fin,
                                'gimnasio' => $id_gimnasio
                            ]);

                            $eventos[] = [
                                'title' => $clase['clase']['nombre'],
                                'start' => $startTime->toIso8601String(),
                                'end' => $endTime->toIso8601String(),
                                'url' => $route,
                                'color' => $color,
                                'classNames' => 'texto-calendario'
                            ];
                        }
                    }
                }
            }
        }

        return view('clases', compact('gimnasios', 'clases', 'selectedGimnasio', 'eventos'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
