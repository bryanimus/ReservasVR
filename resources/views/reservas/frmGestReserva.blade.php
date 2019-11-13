@extends('layout')

@section('title','Gestionar Reserva')

@section('scripts')
	<script type="text/javascript">
		var validateForm;
		var showFields;

		validateForm = function (){
			var blnContinue = true;
			document.getElementById('estado').classList.remove('is-invalid'); document.getElementById('salon_id').classList.remove('is-invalid');
			document.getElementById('cost').classList.remove('is-invalid');

			if (document.getElementById('estado').selectedIndex == 0){ document.getElementById('estado').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('estado').value == "3" && document.getElementById('salon_id').selectedIndex == 0) { document.getElementById('salon_id').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('estado').value == "3" && document.getElementById('cost').style.display == 'block' && parseFloat(document.getElementById('cost').value) == 0) {
				document.getElementById('cost').classList.add('is-invalid'); blnContinue = false;
			}

			if (blnContinue)
				frmGestReserva.submit();
			else
				alert('Favor Completar Información Requerida');
		}

		showFields = function(){
			var objEstado = document.getElementById('estado');
			if (estado.value == "3"){
				document.getElementById('salon_id_lbl').style.display = 'block';
				document.getElementById('salon_id').style.display = 'block';
				@if ($costoEvento == "Presupuesto")
					document.getElementById('cost_lbl').style.display = 'block';
					document.getElementById('cost').style.display = 'block';
				@endif
			}
			else
			{
				document.getElementById('salon_id_lbl').style.display = 'none';
				document.getElementById('salon_id').style.display = 'none';
				document.getElementById('cost_lbl').style.display = 'none';
				document.getElementById('cost').style.display = 'none';
			}
		}

		setTwoNumberDecimal = function(obj){
			obj.value = parseFloat(obj.value).toFixed(2);
		}
	</script>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-10 mx-auto">
			<form id="frmGestReserva" class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{ route('reserva.storeGestReserva', $id) }}">
				@method('PATCH')
				@csrf

				<h2><center>Información Reserva del Evento</center></h2>
				<hr>
				<table class="table table-sm table-bordered" id ="tblInfoReserva" name ="tblInfoReserva">
					<thead class="thead-light"><th style="width: 30%"><center>Elemento</center></th><th style="width: 70%"><center>Detalle</center></th></tr></thead>
					<tbody>
						<tr><td>Fecha de Solicitud</td><td>{{ $fechaSolicitud }}</td></tr>
						<tr><td>Fecha/Hora de Reunión</td><td>{{ $fechaReunion . ' ' . $horaInicio . ' - ' . $horaFin }}</td></tr>
						<tr><td>Encargado del Evento</td><td>{{ $userEncargado }}</td></tr>
						<tr><td>Creador del Evento</td><td>{{ $userAsignado }}</td></tr>
						<tr><td>Centro de Convención</td><td>{{ $convention }}</td></tr>
						<tr><td>Ministerio</td><td>{{ $ministry }}</td></tr>
						<tr><td>Costo del Evento</td><td>{{ $costoEvento }}</td></tr>
						<tr><td>Tipo de Reunión</td><td>{{ $tipoReunion }}</td></tr>
						<tr><td>Propósito de la Reunión</td><td>{{ $proposito }}</td></tr>
						<tr><td>Cantidad de Personas</td><td>{{ $cantidadPersona }}</td></tr>
						<tr><td>Tipo de Montaje</td><td>{{ $montaje }}</td></tr>
						<tr><td>Tipo de Manteleria</td><td>@if (!is_null($manteleria)){{ $manteleria }} @endif</td></tr>
						<tr><td>Musical</td><td>@if (!is_null($musical)) {{ $musical }} @endif</td></tr>
						<tr><td>Requerimiento Técnico</td><td>
							@if (count($ReqTecnico))
							<ul>
								@foreach($ReqTecnico as $value)
									<li>{{ $value->nombre }}</li>
								@endforeach
							</ul>
							@endif
						</td></tr>
						<tr><td>Cristalería y Loza</td><td>
							@if (count($Cristaleria))
							<ul>
								@foreach($Cristaleria as $value)
									<li>{{ $value->nombre }}</li>
								@endforeach
							</ul>
							@endif
						</td></tr>
						<tr><td>Alimentos y Bebidas</td><td>
							@if (count($Alimento))
							<ul>
								@foreach($Alimento as $value)
									<li>{{ $value->nombre }}</li>
								@endforeach
							</ul>
							@endif
						</td></tr>
						<tr><td>Observaciones Adicionales</td><td>@if (!is_null($observaciones)) {{ $observaciones }} @endif</td></tr>
					</tbody>
				</table>

				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="estado">Estado <strong>(*)</strong></label>
						<select class ="form-control" name="estado" id= "estado" onchange="removeClassCmb(this);showFields();">
							<option value="">Seleccione Estado</option>
							<option value="2">Rechazado</option>
							<option value="3">Aprobado</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label id="salon_id_lbl" for="salon_id" style="display:none;">Salón <strong>(*)</strong></label>
						<select class ="form-control" id="salon_id" name="salon_id" onchange="removeClassCmb(this);" style="display:none;">
							<option value="">Seleccione Salón</option>
							@foreach ($salones as $id => $name)
								<option value="{{ $id }}">{{ $name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-4">
						<label id="cost_lbl" for="cost" style="display:none;">Presupuesto <strong>(*)</strong></label>
						<input type="number" class ="form-control" name="cost" id="cost" style="display:none;" onchange="setTwoNumberDecimal(this);" onfocusout="removeClassNumber(this);" min="0" max="100000000" step="0.01" value="0.00" />
					</div>
				</div>

				<button id="btnGuardar" type="button" class="btn btn-primary btn-lg btn-block" onclick="validateForm();">Aceptar</button>
			</form>
		</div>
	</div>
</div>
@endsection