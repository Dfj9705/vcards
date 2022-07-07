@extends('layouts.app')
@section('content')
    <div id="calendar"></div>
@endsection
@section('scripts')
    
    {{-- <script src='fullcalendar/main.js'></script> --}}
    <script>
        const calendarElement = document.getElementById('calendar');
        // Toast.fire()
        document.addEventListener('DOMContentLoaded', () => {
            renderCalendar(calendarElement, {!! $cotizaciones !!});
        })
        
    </script>
@endsection