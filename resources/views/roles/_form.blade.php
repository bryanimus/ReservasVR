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

		<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>
		<a class="btn btn-link btn-block" href="{{ route('role.index') }}">Cancelar</a>