		@csrf
		<div class="form-group">
			<label for="name">Nombre</label>
			<input class="form-control bg-light shadow-sm
						@error('name') is-invalid @else border-0 @enderror"
				id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
				onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);">
			@error('name') @include('partials.showError') @enderror
		</div>
		<div class="form-group">
			<label for="email">Correo Electrónico</label>
			<input class="form-control bg-light shadow-sm
						@error('email') is-invalid @else border-0 @enderror"
				id="email" type="text" name="email" value="{{ old('email', $user->email) }}"
				onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);">
			@error('email') @include('partials.showError') @enderror
		</div>
		<div class="form-group">
			<label for="rol">Rol</label>
			<select class="form-control
						@error('role_id') is-invalid @else border-0 @enderror"
				id="type" name="role_id" onchange="removeClassCmb(this);">
				<option value="">Seleccione Rol</option>
				@foreach ($roles as $id => $nombre)
					<option value="{{ $id }}"
						@if ($id == old('role_id', $user->role_id))
							selected="selected"
						@endif
					>{{ $nombre }}</option>
				@endforeach
			</select>
			@error('role_id') @include('partials.showError') @enderror
		</div>
		<div class="form-group">
			<div class="form-check form-check-inline">
			  	<input class="form-check-input" type="radio" name="typeUser" id="typeUser1" onchange="document.getElementById('valType').value='';checkRadio('1');">
				<label class="form-check-label" for="typeUser1">Ministerio</label>
			</div>
			<div class="form-check form-check-inline">
				<input class="form-check-input" type="radio" name="typeUser" id="typeUser2" onchange="document.getElementById('valType').value='';checkRadio('2');">
				<label class="form-check-label" for="typeUser2">Departamento</label>
			</div>
		</div>
		<div class="form-group">
			<select class="form-control
						@error('ministry_id') is-invalid @else border-0 @enderror"
				id="ministry_id" name="ministry_id" onchange="removeClassCmb(this);saveID(this);">
				<option value="">Seleccione Ministerio</option>
				@foreach ($ministries as $id => $nombre)
					<option value="{{ $id }}">{{ $nombre }}</option>
				@endforeach
			</select>
			@error('ministry_id') @include('partials.showError') @enderror
			<select class="form-control
						@error('department_id') is-invalid @else border-0 @enderror"
				id="department_id" name="department_id" onchange="removeClassCmb(this);saveID(this);">
				<option value="">Seleccione Departamento</option>
				@foreach ($departments as $id => $nombre)
					<option value="{{ $id }}">{{ $nombre }}</option>
				@endforeach
			</select>
			@error('department_id') @include('partials.showError') @enderror
		</div>
		@unless($user->id)
			<div class="form-group">
				<label for="password">Contraseña</label>
				<input class="form-control bg-light shadow-sm
							@error('password') is-invalid @else border-0 @enderror"
					id="password" type="password" name="password"
					onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);">
				@error('password') @include('partials.showError') @enderror
			</div>
			<div class="form-group">
				<label for="password_confirmation">Confirmación Contraseña</label>
				<input class="form-control bg-light shadow-sm
							@error('password_confirmation') is-invalid @else border-0 @enderror"
					id="password_confirmation" type="password" name="password_confirmation"
					onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);">
				@error('password_confirmation') @include('partials.showError') @enderror
			</div>
		@endunless
		<input type="hidden" id="opcType" name = "opcType" value="{{ old('opcType', $tipo)  }}">
		<input type="hidden" id="valType" name = "valType" value="{{ old('valType', $valueTipo) }}">
		<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>
		<a class="btn btn-link btn-block" href="{{ route('user.index') }}">Cancelar</a>