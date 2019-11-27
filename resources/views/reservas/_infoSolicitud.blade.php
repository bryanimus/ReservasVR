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