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

    ];

@endphp
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            eventContent: function(arg){

                    let startTime = arg.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
                    let endTime = arg.event.end ? arg.event.end.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : '';
                    let eventTitle = arg.event.title;

                    // Añadir el círculo de color a la izquierda
                    let dotEl = document.createElement('div');
                    dotEl.classList.add('fc-daygrid-event-dot');
                    dotEl.style.borderColor = arg.event.backgroundColor || arg.event.borderColor;

                    // Crear contenedor para el contenido personalizado
                    let customContentEl = document.createElement('div');
                    customContentEl.innerHTML = `<b>${startTime} - ${endTime}</b><br>${eventTitle}`;

                    return { domNodes: [dotEl, customContentEl] };

                },
            events: [
                @foreach($clases as $clase)

                    @foreach($clase->horario as $horario)
                        @php
                            $nombreClase = $clase['clase']['tipo_clase']['nombre'];

                            // Obtener todos los días del mes
                            $firstDayOfMonth = \Carbon\Carbon::now()->startOfMonth();
                            $lastDayOfMonth = \Carbon\Carbon::now()->endOfMonth();
                            $dates = \Carbon\CarbonPeriod::create($firstDayOfMonth, $lastDayOfMonth);

                            // Filtrar para obtener solo los días que coinciden con el día de la semana especificado
                            $filteredDates = collect($dates)->filter(function ($date) use ($horario) {
                                return $date->dayOfWeek === $horario['dia'];
                            });

                            $color = $colorMapping[$nombreClase] ?? '#378006'; // Color por defecto si no se encuentra

                        @endphp

                        @foreach($filteredDates as $date)
                            @php

                                // Establecer la hora de inicio y fin en base al horario
                                $startTime = $date->copy()->setHour($horario['horaInicio'])->setMinute(0);
                                $endTime = $date->copy()->setHour($horario['horaFin'])->setMinute(0);

                            @endphp
                            {
                                title: '{{ $clase['clase']['nombre'] }}',
                                start: '{{ $startTime }}',
                                end: '{{ $endTime }}',
                                url: '{{ url('clase/'.$clase->_id) }}',
                                color: '{{$color}}',
                                classNames : "texto-calendario"
                            },
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
