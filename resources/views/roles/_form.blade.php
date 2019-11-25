		@csrf
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input class="form-control bg-light shadow-sm
							@error('nombre') is-invalid @else border-0 @enderror"
				id="nombre" type="text" name="nombre" value="{{ old('nombre', $role->nombre) }}"
				onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);">
			@error('nombre') @include('partials.showError')	@enderror
		</div>

		<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<textarea class="form-control bg-light shadow-sm
							@error('descripcion') is-invalid @else border-0 @enderror"
				id="descripcion" name="descripcion" onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);">{{ old('descripcion', $role->descripcion) }}</textarea>
			@error('descripcion') @include('partials.showError') @enderror
		</div>

		<div class="form-check">
			<input class="form-check-input" type="checkbox" id="isAdmin" name="isAdmin"
			@if (old('isAdmin', $role->isAdmin)) checked @endif>
			<label class="form-check-label" for="isAdmin">Es Administrador</label>
		</div>
		</br>

		<h3>Accesos</h3>
		<hr>
		<div class="form-row">
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accCentConv" name="accCentConv"
					@if (old('accCentConv', $role->accCentConv)) checked @endif>
					<label class="form-check-label" for="accCentConv">Centros de Convenciones</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accMinisterio" name="accMinisterio"
					@if (old('accMinisterio', $role->accMinisterio)) checked @endif>
					<label class="form-check-label" for="accMinisterio">Ministerios</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accSalones" name="accSalones"
					@if (old('accSalones', $role->accSalones)) checked @endif>
					<label class="form-check-label" for="accSalones">Salones</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accDepto" name="accDepto"
					@if (old('accDepto', $role->accDepto)) checked @endif>
					<label class="form-check-label" for="accDepto">Departamentos</label>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accTipoReunion" name="accTipoReunion"
					@if (old('accTipoReunion', $role->accTipoReunion)) checked @endif>
					<label class="form-check-label" for="accTipoReunion">Tipos de Reuniones</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accRecurso" name="accRecurso"
					@if (old('accRecurso', $role->accRecurso)) checked @endif>
					<label class="form-check-label" for="accRecurso">Recursos</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accRol" name="accRol"
					@if (old('accRol', $role->accRol)) checked @endif>
					<label class="form-check-label" for="accRol">Roles</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="accUsuario" name="accUsuario"
					@if (old('accUsuario', $role->accUsuario)) checked @endif>
					<label class="form-check-label" for="accRol">Usuarios</label>
				</div>
			</div>
		</div>

		<h3>Opciones Reservación</h3>
		<hr>
		<div class="form-row">
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="opcSolicitar" name="opcSolicitar"
					@if (old('opcSolicitar', $role->opcSolicitar)) checked @endif>
					<label class="form-check-label" for="opcSolicitar">Solicitar</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="opcAprobar" name="opcAprobar"
					@if (old('opcAprobar', $role->opcAprobar)) checked @endif>
					<label class="form-check-label" for="opcAprobar">Aprobar</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="opcReserva" name="opcReserva"
					@if (old('opcReserva', $role->opcReserva)) checked @endif>
					<label class="form-check-label" for="opcReserva">Reservar</label>
				</div>
			</div>
			<div class="form-group col-md-3">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="visEvenPriv" name="visEvenPriv"
					@if (old('visEvenPriv', $role->visEvenPriv)) checked @endif>
					<label class="form-check-label" for="visEvenPriv">Visualizar Eventos Privados</label>
				</div>
			</div>
		</div>

		<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>
		<a class="btn btn-link btn-block" href="{{ route('role.index') }}">Cancelar</a>