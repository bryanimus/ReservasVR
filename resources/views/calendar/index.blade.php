@extends('layout')

@section('title','Calendario')
@section('styles')
    <link rel="stylesheet" href="{{asset('FullCalendar/fullcalendar.css')}}">
    <style type="text/css">
        br {
            display: block; /* makes it have a width */
            content: ""; /* clears default height */
            margin-top: 0; /* change this to whatever height you want it */
        }
        h1, h2, h3, h4, h5, h6{
          margin-top:20px;
          margin-bottom:10px;
        }
        tab1 { padding-left: 4em; }
    </style>
@endsection
@section('scripts')
    <script src="{{asset('Jquery/jquery-3.4.1.min.js')}}" defer></script>
    <script src="{{asset('Jquery/jquery-ui.min.js')}}" defer></script>
    <script src="{{asset('js/app.js')}}" defer></script>
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
                events:{!! $data !!},
                eventClick: function(event) {
                    $("#ModalCenter .modal-header h5").text(event.title);

                    document.getElementById('lblID').innerText = event.id;
                    document.getElementById('lblFechaHora').innerText = event.fecha_hora;
                    document.getElementById('lblConvention').innerText = event.convention;
                    document.getElementById('lblUserEncargado').innerText = event.user_encargado;

                    $("#ModalCenter").modal("show");
                }
            });
        };
    </script>
@endsection
@section('content')
    <br>
    <div class="container">
        <div id="calendar"></div>
        <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalLongTitle"></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            <strong>ID: </strong><a id="lblID"></a><br>
                            <strong>Fecha/Hora Reunión: </strong><a id="lblFechaHora"></a><br>
                            <strong>Centro de Convenciones: </strong><a id="lblConvention"></a><br>
                            <strong>Usuario Encargado: </strong><a id="lblUserEncargado"></a><br>
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
