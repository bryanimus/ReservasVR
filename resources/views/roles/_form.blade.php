		@csrf
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input class="form-control bg-light shadow-sm
							@error('nombre') is-invalid @else border-0 @enderror"
				id="nombre" type="text" name="nombre" value="{{ old('nombre', $role->nombre) }}">
			@error('nombre') @include('partials.showError')	@enderror
		</div>

		<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<textarea class="form-control bg-light shadow-sm
							@error('descripcion') is-invalid @else border-0 @enderror"
				id="descripcion" name="descripcion">{{ old('descripcion', $role->descripcion) }}</textarea>
			@error('descripcion') @include('partials.showError') @enderror
		</div>

		<h3>Accesos</h3>
		<hr>
		<div class="form-row">
			<div class="form-group col-md-4">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accCentConv" name="accCentConv">
					<label class="form-check-label" for="accCentConv">Centros de Convenciones</label>
				</div>
			</div>
			<div class="form-group col-md-4">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accMinisterio" name="accMinisterio">
					<label class="form-check-label" for="accMinisterio">Ministerios</label>
				</div>
			</div>
			<div class="form-group col-md-4">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accSalones" name="accSalones">
					<label class="form-check-label" for="accSalones">Salones</label>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accTipoReunion" name="accTipoReunion">
					<label class="form-check-label" for="accTipoReunion">Tipos de Reuniones</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accRecurso" name="accRecurso">
					<label class="form-check-label" for="accRecurso">Recursos</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accRol" name="accRol">
					<label class="form-check-label" for="accRol">Roles</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accUsuario" name="accUsuario">
					<label class="form-check-label" for="accRol">Usuarios</label>
				</div>
			</div>
		</div>

		<h3>Opciones Reservación</h3>
		<hr>
		<div class="form-row">
			<div class="form-group col-md-4">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="opcReserva" name="opcReserva">
					<label class="form-check-label" for="opcReserva">Reservar</label>
				</div>
			</div>
			<div class="form-group col-md-4">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="opcReserva" name="opcReserva">
					<label class="form-check-label" for="opcReserva">Aprobar</label>
				</div>
			</div>
		</div>

		<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>
		<a class="btn btn-link btn-block" href="{{ route('role.index') }}">Cancelar</a>