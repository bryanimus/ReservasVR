@extends('layout')

@section('title','Eventos')
@section('scripts')
	<script type="text/javascript" defer>
		var validateForm;

		validateForm = function(){
			var blnContinue = true;

			document.getElementById('reserve_id').classList.remove('is-invalid'); document.getElementById('altreserva').style.display = 'none';

			if (isNaN(parseInt(document.getElementById('reserve_id').value.trim())) && document.getElementById('reserve_id').value.trim() != '') {
				document.getElementById('altreserva').style.display = 'block'; blnContinue = false;}

			if (blnContinue)
				fltEvent.submit();
			else
				alert('Favor Completar Información Requerida');
		}
	</script>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-10 mx-auto">
			<form id="fltEvent" class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{ route('reporte.showevent') }}">
				@csrf
				<h2>Eventos</h2>
				<hr>

				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="convention">Centro de Convención</label>
						<select class="form-control" id="type" name="convention_id">
							<option value="">Seleccione Centro de Convencion</option>
							@foreach ($conventions as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="reserve_id">ID Reserva</label>
						<input class="form-control" id="reserve_id" type="text" name="reserve_id" onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);">
						<span id="altreserva" class="invalid-feedback" style="display:none;" role="alert"><strong>El campo ID Reserva debe ser numérico</strong></span>
					</div>
					<div class="form-group col-md-4">
						<label for="estado">Estado</label>
						<select class="form-control" id="type" name="estado">
							<option value="">Seleccione Estado</option>
							<option value="1">En Solicitud</option>
							<option value="2">Rechazado</option>
							<option value="3">Aprobado</option>
							<option value="4">Reservado</option>
							<option value="5">Finalizado</option>
							<option value="6">Evaluado</option>
							<option value="7">Eliminado</option>
						</select>
					</div>
				</div>
				<button id="btnFilter" type="button" class="btn btn-primary btn-lg btn-block" onclick="validateForm();">Consultar</button>
			</form>
		</div>
	</div>
</div>
@endsection