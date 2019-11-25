		@csrf
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input class="form-control bg-light shadow-sm
						@error('nombre') is-invalid @else border-0 @enderror"
				id="nombre" type="text" name="nombre" value="{{ old('nombre', $department->nombre) }}"
				onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);">
			@error('nombre') @include('partials.showError')	@enderror
		</div>

		<div class="form-group">
			<label for="descripcion">Descripción</label>
			<textarea class="form-control bg-light shadow-sm
							@error('descripcion') is-invalid @else border-0 @enderror"
				id="descripcion" name="descripcion" onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);">{{ old('descripcion', $department->descripcion) }}</textarea>
			@error('descripcion') @include('partials.showError') @enderror
		</div>

		<div class="form-group">
			<label for="convention">Centro de Convención</label>
			<select class="form-control
						@error('convention_id') is-invalid @else border-0 @enderror"
				id="type" name="convention_id" onchange="removeClassCmb(this);">
				<option value="">Seleccione Centro de Convencion</option>
				@foreach ($conventions as $id => $nombre)
					<option value="{{ $id }}"
						@if ($id == old('convention_id', $department->convention_id))
							selected="selected"
						@endif
					>{{ $nombre }}</option>
				@endforeach
			</select>
			@error('convention_id') @include('partials.showError')	@enderror
		</div>

		<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>
		<a class="btn btn-link btn-block" href="{{ route('department.index') }}">Cancelar</a>