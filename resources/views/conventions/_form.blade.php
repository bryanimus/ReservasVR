
		@csrf
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input class="form-control bg-light shadow-sm
						@error('nombre') is-invalid @else border-0 @enderror"
				id="nombre" type="text" name="nombre" value="{{ old('nombre', $convention->nombre) }}"
				onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);" >
			@error('nombre') @include('partials.showError')	@enderror
		</div>

		<div class="form-group">
			<label for="direccion">Dirección</label>
			<input class="form-control bg-light shadow-sm
						@error('direccion') is-invalid @else border-0 @enderror"
				id="direccion" type="text" name="direccion" value="{{ old('direccion', $convention->direccion) }}"
				onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);" >
			@error('direccion') @include('partials.showError')	@enderror
		</div>

		<div class="form-group">
			<label for="telefono">Teléfono</label>
			<input class="form-control bg-light shadow-sm
						@error('telefono') is-invalid @else border-0 @enderror"
				id="telefono" type="text" name="telefono" value="{{ old('telefono', $convention->telefono) }}"
				onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);" >
			@error('telefono') @include('partials.showError')	@enderror
		</div>

		<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>
		<a class="btn btn-link btn-block" href="{{ route('convention.index') }}">Cancelar</a>