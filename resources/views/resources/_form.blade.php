		@csrf
		<div class="form-group">
			<label for="nombre">Nombre</label>
			<input class="form-control bg-light shadow-sm
							@error('nombre') is-invalid @else border-0 @enderror"
				id="nombre" type="text" name="nombre" value="{{ old('nombre', $resource->nombre) }}">
			@error('nombre') @include('partials.showError')	@enderror
		</div>

		<div class="form-group">
			<label for="descripcion">Descripcion</label>
			<textarea class="form-control bg-light shadow-sm
							@error('descripcion') is-invalid @else border-0 @enderror"
				id="descripcion" name="descripcion">{{ old('descripcion', $resource->descripcion) }}</textarea>
			@error('descripcion') @include('partials.showError') @enderror
		</div>

		<div class="form-group">
			<label for="tipo">Tipo Recurso</label>
			<select class="form-control
						@error('tipo') is-invalid @else border-0 @enderror"
				id="type" name="tipo" @isset($resource->tipo) disabled @endisset>
				<option value="">Seleccione Tipo Recurso</option>
					<option value="1" @if ("1" == old('tipo', $resource->tipo)) selected="selected" @endif>Montaje</option>
					<option value="2" @if ("2" == old('tipo', $resource->tipo)) selected="selected" @endif>Manteleria</option>
					<option value="3" @if ("3" == old('tipo', $resource->tipo)) selected="selected" @endif>Requerimiento Técnico</option>
					<option value="4" @if ("4" == old('tipo', $resource->tipo)) selected="selected" @endif>Musical</option>
					<option value="5" @if ("5" == old('tipo', $resource->tipo)) selected="selected" @endif>Cristalería y Loza</option>
					<option value="6" @if ("6" == old('tipo', $resource->tipo)) selected="selected" @endif>Alimentos y Bebidas</option>
			</select>
			@error('tipo') @include('partials.showError')	@enderror
		</div>

		<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>
		<a class="btn btn-link btn-block" href="{{ route('resource.index') }}">Cancelar</a>