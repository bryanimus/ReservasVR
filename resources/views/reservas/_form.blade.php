		@csrf
		<div class="form-group">
			<label for="codigoReserva">Codigo de Reserva</label>
			<input class="form-control border-0 bg-light shadow-sm" id="codigoReserva" type="text" name="codigoReserva" value="{{ $codigoReserva }}"
				readonly="readonly">
		</div>

		<div class="form-group">
			<label for="rol">Centro de Convencion</label>
			<select class="form-control" id="type" name="convention_id">
				<option value="">Seleccione Centro de Convencion</option>
				@foreach ($conventions as $id => $nombre)
					<option value="{{ $id }}"
						@if ($id == old('convention_id', $reserva->convention_id))
							selected="selected"
						@endif
					>{{ $nombre }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="rol">Salon</label>
			<select class="form-control" id="type" name="salon_id">
				<option value="">Seleccione Salon</option>
				@foreach ($salones as $id => $nombre)
					<option value="{{ $id }}"
						@if ($id == old('salon_id', $reserva->salon_id))
							selected="selected"
						@endif
					>{{ $nombre }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			<label for="rol">Tipo de Reunion</label>
			<select class="form-control" id="type" name="reuniontype_id">
				<option value="">Seleccione Tipo de Reunion</option>
				@foreach ($tiposreunion as $id => $nombre)
					<option value="{{ $id }}"
						@if ($id == old('reuniontype_id', $reserva->reuniontype_id))
							selected="selected"
						@endif
					>{{ $nombre }}</option>
				@endforeach
			</select>
		</div>

						<div class="form-group">
                            <label for="date">Fecha</label>
                            <div class="input-group">
                                <input type="text" class="form-control datepicker" name="date">
                                <div class="input-group-addon">
                                    <span class="glyphicon glyphicon-th"></span>
                                </div>
                            </div>
                        </div>

		<div class="form-group">
			<label for="hora_reserva">Hora Reserva</label>
			<input id="timepicker1" type="text" class="form-control input-small">
        	<span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
		</div>

		<div class="form-group">
			<label for="duracion">Duracion (Min)</label>
			<input class="form-control border-0 bg-light shadow-sm" id="duracion" type="text" name="duracion" value="{{ old('duracion', $reserva->duracion) }}">
		</div>
		<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>
		<a class="btn btn-link btn-block" href="{{ route('reservaIng.index') }}">Cancelar</a>