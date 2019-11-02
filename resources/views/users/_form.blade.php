		@csrf
		<div class="form-group">
			<label for="name">Nombre</label>
			<input class="form-control bg-light shadow-sm
						@error('name') is-invalid @else border-0 @enderror"
				id="name" type="text" name="name" value="{{ old('name', $user->name) }}">
			@error('name') @include('partials.showError') @enderror
		</div>
		<div class="form-group">
			<label for="email">Correo Electrónico</label>
			<input class="form-control bg-light shadow-sm
						@error('email') is-invalid @else border-0 @enderror"
				id="email" type="text" name="email" value="{{ old('email', $user->email) }}">
			@error('email') @include('partials.showError') @enderror
		</div>
		<div class="form-group">
			<label for="rol">Rol</label>
			<select class="form-control
						@error('role_id') is-invalid @else border-0 @enderror"
				id="type" name="role_id">
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
			<label for="rol">Ministerio</label>
			<select class="form-control
						@error('ministry_id') is-invalid @else border-0 @enderror"
				id="type" name="ministry_id">
				<option value="">Seleccione Ministerio</option>
				@foreach ($ministries as $id => $nombre)
					<option value="{{ $id }}"
						@if ($id == old('ministry_id', $user->ministry_id))
							selected="selected"
						@endif
					>{{ $nombre }}</option>
				@endforeach
			</select>
			@error('role_id') @include('partials.showError') @enderror
		</div>
		@unless($user->id)
			<div class="form-group">
				<label for="password">Contraseña</label>
				<input class="form-control bg-light shadow-sm
							@error('password') is-invalid @else border-0 @enderror"
					id="password" type="password" name="password">
				@error('password') @include('partials.showError') @enderror
			</div>
			<div class="form-group">
				<label for="password_confirmation">Confirmación Contraseña</label>
				<input class="form-control bg-light shadow-sm
							@error('password_confirmation') is-invalid @else border-0 @enderror"
					id="password_confirmation" type="password" name="password_confirmation">
				@error('password_confirmation') @include('partials.showError') @enderror
			</div>
		@endunless
		<button class="btn btn-primary btn-lg btn-block">{{ $btnText }}</button>
		<a class="btn btn-link btn-block" href="{{ route('user.index') }}">Cancelar</a>