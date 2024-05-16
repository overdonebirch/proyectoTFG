@extends('layouts.plantilla')

@section('scriptCalendario')

@php

    $firstDayOfMonth = \Carbon\Carbon::now()->startOfMonth();

    // Obtener el último día del mes actual
    $lastDayOfMonth = \Carbon\Carbon::now()->endOfMonth();

    // Generar un rango de fechas para todos los días del mes
    $dates = \Carbon\CarbonPeriod::create($firstDayOfMonth, $lastDayOfMonth);

    $colorMapping = [
        'Cardio' => '#BBFF04',
        'Relajacion' => '#F7D1E2',
        'Tonificar' => '#393D3C',
        'Baile' => '#FF5D12',
        // Añade más tipos y colores según sea necesario
    ];

@endphp
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                @foreach($clases as $clase)
                    @foreach($clase->gimnasios as $gimnasio)
                        @foreach($gimnasio['horario'] as $horario)
                            @php
                                // Obtener todos los días del mes
                                $firstDayOfMonth = \Carbon\Carbon::now()->startOfMonth();
                                $lastDayOfMonth = \Carbon\Carbon::now()->endOfMonth();
                                $dates = \Carbon\CarbonPeriod::create($firstDayOfMonth, $lastDayOfMonth);

                                // Filtrar para obtener solo los días que coinciden con el día de la semana especificado
                                $filteredDates = collect($dates)->filter(function ($date) use ($horario) {
                                    return $date->dayOfWeek === $horario['dia'];
                                });

                                $color = $colorMapping[$clase->tipo_clase['nombre']] ?? '#378006'; // Color por defecto si no se encuentra
                            @endphp

                            @foreach($filteredDates as $date)
                                @php
                                    // Establecer la hora de inicio y fin en base al horario
                                    $startTime = $date->copy()->setHour($horario['horaInicio'])->setMinute(0);
                                    $endTime = $date->copy()->setHour($horario['horaFin'])->setMinute(0);


                                @endphp
                                {
                                    title: '{{ $clase->nombre }}',
                                    start: '{{ $startTime }}',
                                    end: '{{ $endTime }}',
                                    url: '{{ url('clase/'.$clase->_id) }}',
                                    color: '{{$color}}',
                                    classNames : "texto-calendario"
                                },
                            @endforeach
                        @endforeach
                    @endforeach
                @endforeach
            ]
        });
        calendar.render();
    });
</script>

@endsection

@section('middle')
    <div id='calendar'></div>
@endsection
