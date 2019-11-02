@extends('layout')

@section('title','Reservar')

@section('scripts')
	<script type="text/javascript">
		var addMinistries;
		var minMaxPersons;

		addMinistries = function(){
			var idConvention = frmReserva.convention_id.value;
			var objMinistry = frmReserva.ministry_id;
			var option;

			$.get('/reserva/getMinistry/' + idConvention).done(
				function(response){
					while (objMinistry.length > 1)
						objMinistry.remove(1);
					for (var i = 0; i < response.length; i++){
						option = document.createElement('option');
						option.text = response[i].nombre;
						option.value = response[i].id;
						objMinistry.add(option);
					}
			})
		}

		minMaxPersons = function(){
			var indexSizeReunion = frmReserva.tamano_reunion.value;
			switch(indexSizeReunion){
				case "1":
					frmReserva.cantidad_persona.min=6;
					frmReserva.cantidad_persona.max=70;
					frmReserva.cantidad_persona.value=6;
					break;
				case "2":
					frmReserva.cantidad_persona.min=71;
					frmReserva.cantidad_persona.max=230;
					frmReserva.cantidad_persona.value=71;
					break;
				case "3":
					frmReserva.cantidad_persona.min=300;
					frmReserva.cantidad_persona.max=800;
					frmReserva.cantidad_persona.value=300;
					break;
			}
		}
	</script>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-10 mx-auto">
			<form id="frmReserva" class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{ route('reserva.store') }}">
				@csrf
				<h2>Información General</h2>
				<hr>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="convention">Centro de Convención <strong>(*)</strong></label>
						<select class ="form-control @error('convention_id') is-invalid @enderror" id="type" name="convention_id" id= "convention_id"
							onChange="addMinistries();">
							<option value="">Seleccione Centro de Convencion</option>
							@foreach ($conventions as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
						@error('convention_id') @include('partials.showError')	@enderror
					</div>
					<div class="form-group col-md-6">
						<label for="tamano_reunion">Tamaño de la Reunión <strong>(*)</strong></label>
						<select class ="form-control"  id="type" name="tamano_reunion" onChange="minMaxPersons();">
							<option value="">Seleccione Cantidad de Personas</option>
								<option value="1">de 6 a 70 personas máximo</option>
								<option value="2">de 71 a 230 personas máximo</option>
								<option value="3">de 300 a 800 personas máximo</option>
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="ministry_id">Ministerio <strong>(*)</strong></label>
						<select class ="form-control" id="type" name="ministry_id" id= "ministry_id">
							<option value="">Seleccione Ministerio</option>
						</select>
					</div>
					<div class="form-group col-md-6">
						<label for="user_encargado_id">Encargado del Evento <strong>(*)</strong></label>
						<select class ="form-control" id="type" name="user_encargado_id">
							<option value="">Seleccione Encargado del Evento</option>
							@foreach ($users as $id => $name)
								<option value="{{ $id }}">{{ $name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="costoEvento">Costo del Evento <strong>(*)</strong></label>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="costoEvento" value="1" id="costoEvento1"/>
						<label class="form-check-label" for="costoEvento1">Presupuesto</label>
					</div>
					<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="costoEvento" value="2" id="costoEvento2"/>
						<label class="form-check-label" for="costoEvento2">Pago Directo</label>
					</div>
				</div>

				<div class="form-group">
					<label for="proposito">Proposito de la Reunión <strong>(*)</strong></label>
					<textarea class ="form-control" id="proposito" name="proposito"></textarea>
				</div>

				<h2>Información del Evento</h2>
				<hr>

				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="fecha_reunion">Fecha <strong>(*)</strong></label>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="fecha_reunion">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
					</div>
					<div class="form-group col-md-4">
						<label for="hora_inicio">Hora Inicio <strong>(*)</strong></label>
						<input id="hora_inicio" name="hora_inicio" type="time" class="form-control">
					</div>
					<div class="form-group col-md-4">
						<label for="hora_fin">Hora Fin <strong>(*)</strong></label>
						<input id="hora_fin" name="hora_fin" type="time" class="form-control">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="reuniontype_id">Tipo de Reunión <strong>(*)</strong></label>
						<select class ="form-control" id="type" name="reuniontype_id">
							<option value="">Seleccione Tipo de Reunión</option>
							@foreach ($reuniontypes as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-6">
						<label for="cantidad_persona">Cantidad de Personas <strong>(*)</strong></label>
						<input class="form-control" type="number" name="cantidad_persona" id="cantidad_persona" min="6" max="800" value="6">
					</div>
				</div>

				<h2>Recursos</h2>
				<hr>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="montaje_id">Tipo de Montaje <strong>(*)</strong></label>
						<select class ="form-control" id="type" name="montaje_id">
							<option value="">Seleccione Tipo de Montaje</option>
							@foreach ($montajes as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-6">
						<label for="montaje_id">Tipo de Manteleria</label>
						<select class ="form-control" id="type" name="montaje_id">
							<option value="">Seleccione Tipo de Manteleria</option>
							@foreach ($mantelerias as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="req_tecnico">Requerimiento Técnico <strong>(*)</strong></label>
						<select class ="form-control" id="type" name="req_tecnico">
							<option value="">Seleccione Requerimiento Técnico</option>
							@foreach ($tecnicos as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-1">
						<label for="addReq_Tecnico"></label>
						<button id="addReq_Tecnico" class="btn btn-info btn-xs">Agregar</button>
					</div>
					<div class="form-group col-md-1">
						<label for="delReq_Tecnico"></label>
						<button id="delReq_Tecnico" class="btn btn-danger btn-xs">Eliminar</button>
					</div>
				</div>


				<button class="btn btn-primary btn-lg btn-block">Agregar Reserva</button>
			</form>
		</div>
	</div>
</div>
@endsection