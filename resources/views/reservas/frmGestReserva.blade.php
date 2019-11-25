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
				<table class="table table-sm table-bordered" id ="tblInfoReserva" name ="tblInfoReserva">
					<thead class="thead-light"><th style="width: 30%"><center>Elemento</center></th><th style="width: 70%"><center>Detalle</center></th></tr></thead>
					<tbody>
						<tr><td>Nombre Reserva</td><td>{{ $reserva->NOMBRE_RESERVA }}</td></tr>
						<tr><td>Fecha de Solicitud</td><td>{{ $reserva->FECHA_SOLICITUD }}</td></tr>
						<tr><td>Fecha/Hora de Reunión</td><td>{{ $reserva->FECHA_REUNION . ' ' . $reserva->HORA_INICIO . ' - ' . $reserva->HORA_FIN }}</td></tr>
						<tr><td>Encargado del Evento</td><td>{{ $reserva->USUARIO_ENCARGADO }}</td></tr>
						<tr><td>Usuario Solicitante</td><td>{{ $reserva->USUARIO_SOLICITA }}</td></tr>
						<tr><td>Centro de Convención</td><td>{{ $reserva->CONVENCION }}</td></tr>
						<tr><td>Ministerio</td><td>{{ $reserva->MINISTERIO }}</td></tr>
						<tr><td>Costo del Evento</td><td>{{ $reserva->COSTO_EVENTO }}</td></tr>
						<tr><td>Tipo de Reunión</td><td>{{ $reserva->TIPO_REUNION }}</td></tr>
						<tr><td>Propósito de la Reunión</td><td>{{ $reserva->PROPOSITO }}</td></tr>
						<tr><td>Cantidad de Personas</td><td>{{ $reserva->CANTIDAD_PERSONA }}</td></tr>
						<tr><td>Tipo de Montaje</td><td>{{ $reserva->MONTAJE }}</td></tr>
						<tr><td>Tipo de Manteleria</td><td>{{ $reserva->MANTELERIA }} </td></tr>
						<tr><td>Musical</td><td>{{ $reserva->MUSICAL }}</td></tr>
						<tr><td>Requerimiento Técnico</td><td>
							@if (count($ReqTecnico))
							<ul>
								@foreach($ReqTecnico as $value)
									<li>{{ $value->CANTIDAD . ' - ' . $value->RECURSO }}</li>
								@endforeach
							</ul>
							@endif
						</td></tr>
						<tr><td>Cristalería y Loza</td><td>
							@if (count($Cristaleria))
							<ul>
								@foreach($Cristaleria as $value)
									<li>{{ $value->CANTIDAD . ' - ' . $value->RECURSO }}</li>
								@endforeach
							</ul>
							@endif
						</td></tr>
						<tr><td>Alimentos y Bebidas</td><td>
							@if (count($Alimento))
							<ul>
								@foreach($Alimento as $value)
									<li>{{ $value->CANTIDAD . ' - ' . $value->RECURSO . ' (' . $value->RECURSO_DESC . ')'}}</li>
								@endforeach
							</ul>
							@endif
						</td></tr>
						<tr><td>Observaciones Solicitud</td><td> {{ $reserva->OBSERVACIONES }} </td></tr>
					</tbody>
				</table>

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