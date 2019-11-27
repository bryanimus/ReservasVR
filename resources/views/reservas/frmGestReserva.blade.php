@extends('layout')

@section('title','Aprobar Reserva')

@section('scripts')
	<script type="text/javascript">
		var validateForm;

		validateForm = function (){
			var blnContinue = true;
			document.getElementById('estado').classList.remove('is-invalid');

			if (document.getElementById('estado').selectedIndex == 0){ document.getElementById('estado').classList.add('is-invalid'); blnContinue = false;}

			if (blnContinue)
				frmGestReserva.submit();
			else
				alert('Favor Completar Información Requerida');
		}
	</script>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-10 mx-auto">
			<form id="frmGestReserva" class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{ route('reserva.storeGestReserva', $reserva->ID_RESERVA) }}">
				@method('PATCH')
				@csrf

				<h2><center>Aprobación de Reserva</center></h2>
				<hr>
				@include('reservas._infoSolicitud')

				<hr>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="estado">Estado <strong>(*)</strong></label>
						<select class ="form-control" name="estado" id= "estado" onchange="removeClassCmb(this);">
							<option value="">Seleccione Estado</option>
							<option value="2">Rechazado</option>
							<option value="3">Aprobado</option>
						</select>
					</div>
					<div class="form-group col-md-8">
						<label for="observacion_aprueba">Observaciones</strong></label>
						<textarea class ="form-control" id="observacion_aprueba" name="observacion_aprueba" onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);"></textarea>
					</div>
				</div>

				<button id="btnGuardar" type="button" class="btn btn-primary btn-lg btn-block" onclick="validateForm();">Aprobar</button>
				<a class="btn btn-link btn-block" href="{{ route('reserva.Index') }}">Cancelar</a>
			</form>
		</div>
	</div>
</div>
@endsection