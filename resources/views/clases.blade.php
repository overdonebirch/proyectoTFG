@extends('layouts.plantilla')

@section('scriptCalendario')

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: [
                @foreach($clases as $clase)

                @php
                    // Obtener la fecha del próximo día específico de la semana
                    $nextDayOfWeek = \Carbon\Carbon::now()->next(4);
                    // Establecer la hora de inicio y fin en base a la actividad
                    $startTime = $nextDayOfWeek->copy()->setHour(10)->setMinute(0);
                    $endTime = $nextDayOfWeek->copy()->setHour(11)->setMinute(0);
                @endphp
                {
                    title: '{{ $clase->nombre }}',
                    start: '{{ $startTime }}',
                        end: '{{ $endTime }}',
                    url: 'http://localhost::8000'
                },
                @endforeach
            ]
        });
        calendar.render();
    });
</script>

@endsection

@section('middle')
    <div id='calendar' class=""></div>
@endsection
