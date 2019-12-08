@extends('layout')

@section('title','Programación')
@section('styles')
	<link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.standalone.css')}}">
@endsection
@section('scripts')
	<script src="{{asset('Jquery/jquery-3.4.1.min.js')}}" defer></script>
	<script src="{{asset('DatePicker/js/bootstrap-datepicker.js')}}" defer></script>
	<script src="{{asset('DatePicker/locales/bootstrap-datepicker.es.min.js')}}" defer></script>
	<script type="text/javascript" defer>
		var validateForm;

		validateForm = function(){
			var blnContinue = true;

			document.getElementById('fecha_inicio').classList.remove('is-invalid'); document.getElementById('fecha_final').classList.remove('is-invalid');
			document.getElementById('altfecha').style.display = 'none';

			if (document.getElementById('fecha_inicio').value.trim() == ''){ document.getElementById('fecha_inicio').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('fecha_final').value.trim() == ''){ document.getElementById('fecha_final').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('fecha_inicio').value.trim() != '' && document.getElementById('fecha_final').value.trim() != '') {
				var fechaInicio = document.getElementById('fecha_inicio').value.trim();
				var fechaFin = document.getElementById('fecha_final').value.trim();
				fechaInicio = fechaInicio.substring(6,10) + fechaInicio.substring(3,5) + fechaInicio.substring(0,2);
				fechaFin = fechaFin.substring(6,10) + fechaFin.substring(3,5) + fechaFin.substring(0,2);
				if (fechaInicio > fechaFin) {document.getElementById('altfecha').style.display = 'block';  blnContinue=false; }
			}

			if (blnContinue)
				fltProgram.submit();
			else
				alert('Favor Completar Información Requerida');
		}

		window.onload = function (){
			$('#fecha_inicio').datepicker({
				format: "dd/mm/yyyy",
			    language: "es",
			    autoclose: true
			}).on('changeDate', function(ev){
				document.getElementById('fecha_inicio').classList.remove('is-invalid');
			});

			$('#fecha_final').datepicker({
				format: "dd/mm/yyyy",
			    language: "es",
			    autoclose: true
			}).on('changeDate', function(ev){
				document.getElementById('fecha_final').classList.remove('is-invalid');
			});
		}
	</script>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-10 mx-auto">
			<form id="fltProgram" class="bg-white py-3 px-4 shadow rounded" method="POST" target="_blank"  action="{{ route('reporte.showprogramacion') }}">
				@csrf
				<h2>Programación</h2>
				<hr>
				<div class="form-group">
					<label for="convention">Centro de Convención</label>
					<select class="form-control" id="type" name="convention_id">
						<option value="">Seleccione Centro de Convencion</option>
						@foreach ($conventions as $id => $nombre)
							<option value="{{ $id }}">{{ $nombre }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="fecha_inicio">Fecha Inicio <strong>(*)</strong></label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="fecha_inicio" id="fecha_inicio" readonly="true">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                        <span id="altfecha" class="invalid-feedback" style="display:none;" role="alert"><strong>El campo Fecha Inicio debe ser menor o igual a Fecha Final</strong></span>
					</div>
					<div class="form-group col-md-4">
						<label for="fecha_final">Fecha Final <strong>(*)</strong></label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="fecha_final" id="fecha_final" readonly="true">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
					</div>
				</div>
				<button id="btnFilter" type="button" class="btn btn-primary btn-lg btn-block" onclick="validateForm();">Consultar</button>
			</form>
		</div>
	</div>
</div>
@endsection