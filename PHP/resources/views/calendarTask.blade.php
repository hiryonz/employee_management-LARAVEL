@extends('layout')
@section('title', 'calendar')

@section('content')

<div class="calendar-container">
    <div id='calendar'></div>
</div>


@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');

        // Eventos dinámicos desde el controlador
        var events = @json($events);

        var calendar = new FullCalendar.Calendar(calendarEl, {
            timeZone: 'UTC',
            themeSystem: 'bootstrap5',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            weekNumbers: true,
            dayMaxEvents: true, // Muestra enlace "más" si hay demasiados eventos
            events: events, // Los eventos enviados desde el controlador
            locale: 'es',
            buttonText: { // Traducciones personalizadas
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día',
            list: 'Lista'
        }
        });

        calendar.render();
    });
    </script>
@endpush