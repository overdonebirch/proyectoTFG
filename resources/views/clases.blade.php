@extends('layouts.plantilla')

@section('scriptCalendario')
@php
    $firstDayOfMonth = \Carbon\Carbon::now()->startOfMonth();
    $lastDayOfMonth = \Carbon\Carbon::now()->endOfMonth();
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
                let dotEl = document.createElement('div');
                dotEl.classList.add('fc-daygrid-event-dot');
                dotEl.style.borderColor = arg.event.backgroundColor || arg.event.borderColor;
                let customContentEl = document.createElement('div');
                customContentEl.innerHTML = `<b>${startTime} - ${endTime}</b><br>${eventTitle}`;
                return { domNodes: [dotEl, customContentEl] };
            },
            events: [
                @foreach($clases as $clase)
                    @foreach($clase->horario as $horario)
                        @php
                            $nombreClase = $clase['clase']['tipo_clase']['nombre'];
                            $firstDayOfMonth = \Carbon\Carbon::now()->startOfMonth();
                            $lastDayOfMonth = \Carbon\Carbon::now()->endOfMonth();
                            $dates = \Carbon\CarbonPeriod::create($firstDayOfMonth, $lastDayOfMonth);
                            $filteredDates = collect($dates)->filter(function ($date) use ($horario) {
                                return $date->dayOfWeek === $horario['dia'];
                            });
                            $color = $colorMapping[$nombreClase] ?? '#378006';
                        @endphp
                        @foreach($filteredDates as $date)
                            @php
                                $startTime = $date->copy()->setHour($horario['horaInicio'])->setMinute(0);
                                $endTime = $date->copy()->setHour($horario['horaFin'])->setMinute(0);
                                $fecha = $date->toDateString();
                                $id_clase = $clase['clase']['_id'];
                                $id_gimnasio = $selectedGimnasio->_id;
                                $hora_inicio = $startTime->toTimeString();
                                $_hora_fin = $endTime->toTimeString();
                                $route = route('reservarClase', ['clase' => $clase['clase']['_id'], 'fecha' => $fecha, 'horaInicio' => $hora_inicio,
                                                            'horaFin' => $_hora_fin, 'gimnasio' => $id_gimnasio]);
                            @endphp
                            {
                                title: '{{ $clase['clase']['nombre'] }}',
                                start: '{{ $startTime }}',
                                end: '{{ $endTime }}',
                                url: '{{ $route }}',
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
    <div class="container mt-5">
        <form id="gimnasio-form" method="GET" action="{{ route('clases') }}">
            <div class="form-group">
                <label for="gimnasio">Selecciona un Gimnasio:</label>
                <select id="gimnasio" name="gimnasio_id" class="form-control" onchange="document.getElementById('gimnasio-form').submit()">
                    <option value="">-- Selecciona un Gimnasio --</option>
                    @foreach($gimnasios as $gimnasio)
                        <option value="{{ $gimnasio->id }}" {{ $selectedGimnasio && $selectedGimnasio->id == $gimnasio->id ? 'selected' : '' }}>
                            {{ $gimnasio->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
        <div id='calendar'></div>
    </div>
@endsection
