@extends('layout')

@section('title','Gestionar Reserva')

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
				<div class="form-row">
					<div class="form-group col-md-3">
						<label><strong>Fecha de Solicitud</strong></label> <br>
						<label>{{ $reserva->FECHA_SOLICITUD }}</label>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Fecha/Hora de Reunión</strong></label> <br>
						<label>{{ $reserva->FECHA_REUNION . ' ' . $reserva->HORA_INICIO . ' - ' . $reserva->HORA_FIN}}</label>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Encargado del Evento</strong></label> <br>
						<label>{{ $reserva->USUARIO_ENCARGADO}}</label>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Usuario Solicitante</strong></label> <br>
						<label>{{ $reserva->USUARIO_SOLICITA}}</label>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-3">
						<label><strong>Nombre de la reunión</strong></label> <br>
						<label>{{ $reserva->NOMBRE_RESERVA }}</label>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Tipo de Evento</strong></label> <br>
						<label>{{ $reserva->TIPO_EVENTO_DESC }}</label>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Centro de Convención</strong></label><br>
						<label>{{ $reserva->CONVENCION }}</label>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Ministerio</strong></label><br>
						<label>{{ $reserva->MINISTERIO }}</label>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-3">
						<label><strong>Costo del Evento</strong></label> <br>
						<label>{{ $reserva->COSTO_EVENTO }}</label>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Tipo de Reunión</strong></label> <br>
						<label>{{ $reserva->TIPO_REUNION }}</label>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Cantidad de Personas</strong></label> <br>
						<label>{{ $reserva->CANTIDAD_PERSONA }}</label>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label><strong>Propósito de la Reunión</strong></label> <br>
						<label>{{ $reserva->PROPOSITO }}</label>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-3">
						<label><strong>Tipo de Montaje</strong></label> <br>
						<label>{{ $reserva->MONTAJE }}</label>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Tipo de Manteleria</strong></label> <br>
						<label>{{ $reserva->MANTELERIA }}</label>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Musical</strong></label> <br>
						<label>{{ $reserva->MUSICAL }}</label>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-12">
						<label><strong>Observaciones Solicitud</strong></label> <br>
						<label>{{ $reserva->OBSERVACIONES }}</label>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-4">
						<table class="table table-sm table-bordered">
							<thead class="thead-light"><tr><th><center>Requerimiento Técnico</center></th></tr></thead>
							<tbody><tr>
								@foreach($ReqTecnico as $value)
									<tr><td>{{ $value->CANTIDAD . ' - ' . $value->RECURSO }}</td></tr>
								@endforeach
							</tr></tbody>
						</table>
					</div>
					<div class="form-group col-md-4">
						<table class="table table-sm table-bordered">
							<thead class="thead-light"><tr><th><center>Cristalería y Loza</center></th></tr></thead>
							<tbody><tr>
								@foreach($Cristaleria as $value)
									<tr><td>{{ $value->CANTIDAD . ' - ' . $value->RECURSO }}</td></tr>
								@endforeach
							</tr></tbody>
						</table>
					</div>
					<div class="form-group col-md-4">
						<table class="table table-sm table-bordered">
							<thead class="thead-light"><tr><th><center>Alimentos y Bebidas</center></th></tr></thead>
							<tbody>
								@foreach($Alimento as $value)
									<tr><td>{{ $value->CANTIDAD . ' - ' . $value->RECURSO . ' (' . $value->RECURSO_DESC . ')' }}</td></tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
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

				<button id="btnGuardar" type="button" class="btn btn-primary btn-lg btn-block" onclick="validateForm();">Aceptar</button>
			</form>
		</div>
	</div>
</div>
@endsection