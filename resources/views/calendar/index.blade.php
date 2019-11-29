@extends('layout')

@section('title','Calendario')
@section('styles')
  <link rel="stylesheet" href="{{asset('FullCalendar/fullcalendar.css')}}">
@endsection
@section('scripts')
    <script src="{{asset('Jquery/jquery-3.4.1.min.js')}}" defer></script>
    <script src="{{asset('Jquery/jquery-ui.min.js')}}" defer></script>
    <script src="{{asset('FullCalendar/moment.min.js')}}" defer></script>
    <script src="{{asset('FullCalendar/fullcalendar.min.js')}}" defer></script>
    <script src="{{asset('FullCalendar/locale/locale-all.js')}}" defer></script>

    <script type="text/javascript" defer>
       window.onload = function() {
            var calendar = $('#calendar').fullCalendar({
              locale:'es',
              editable:false,
              header:{
                 left:'prev,next today',
                 center:'title',
                 right:'month,agendaWeek,agendaDay'
                },
                events:{!! $data !!}
          });
       };
    </script>
@endsection
@section('content')
    <br>
    <div class="container">
        <div id="calendar"></div>
    </div>
@endsection
