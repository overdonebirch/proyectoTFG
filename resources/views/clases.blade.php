@extends('layouts.plantilla')

@section('scriptCalendario')
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
            events: @json($eventos)
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
