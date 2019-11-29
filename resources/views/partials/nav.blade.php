	<nav class ="navbar navbar-light navbar-expand-sm bg-white shadow-sm">
		<div class="container">
			<img class="img-fluid mb-4" src="/img/Logotipo.png" alt="Gestion Reservas">
			<button class="navbar-toggler"
				type="button"
				data-toggle="collapse"
				data-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent"
				aria-expanded="false"
				aria-label="	{{ __('Toggle navigation') }}">
	            	<span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="nav nav-pills">
					<li class="nav-item">
						<a class="nav-link" href="{{ route('home') }}">Inicio</a>
					</li>
					@auth
						@if (auth()->user()->accParametrizacion())
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropDownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Parametrización</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									@if (auth()->user()->role->accCentConv) <a class="dropdown-item" href="{{ route('convention.index') }}">Centros de Convenciones</a> @endif
									@if (auth()->user()->role->accMinisterio) <a class="dropdown-item" href="{{ route('ministry.index') }}">Ministerios</a> @endif
									@if (auth()->user()->role->accSalones) <a class="dropdown-item" href="{{ route('salon.index') }}">Salones</a> @endif
									@if (auth()->user()->role->accDepto) <a class="dropdown-item" href="{{ route('department.index') }}">Departamentos</a> @endif
									@if (auth()->user()->role->accTipoReunion) <a class="dropdown-item" href="{{ route('tiporeunion.index') }}">Tipos de Reuniones</a> @endif
									@if (auth()->user()->role->accRecurso) <a class="dropdown-item" href="{{ route('resource.index') }}">Recursos</a> @endif
								</div>
							</li>
						@endif
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropDownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Reservaciones</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="{{ route('calendario.index') }}">Calendario</a>
								@if (auth()->user()->role->opcSolicitar) <a class="dropdown-item" href="{{ route('reserva.Init') }}">Solicitud de Reserva</a> @endif
								@if (auth()->user()->role->opcAprobar) <a class="dropdown-item" href="{{ route('reserva.Index') }}">Aprobación de Reservas</a> @endif
								@if (auth()->user()->role->opcReserva) <a class="dropdown-item" href="{{ route('reserva.resIndex') }}">Reservación de Reservas</a> @endif
							</div>
						</li>
						@if (auth()->user()->accSeguridad())
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" id="navbarDropDownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Seguridad</a>
								<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
									@if (auth()->user()->role->accUsuario) <a class="dropdown-item" href="{{ route('user.index') }}">Usuarios</a> @endif
									@if (auth()->user()->role->accRol) <a class="dropdown-item" href="{{ route('role.index') }}">Roles</a> @endif
								</div>
							</li>
						@endif
					@endauth
					@guest
						<li class="nav-item">
							<a class="nav-link" href="{{ route('login') }}">Ingresar</a>
						</li>
					@else
						<li class="nav-item">
							<a class="nav-link" href="#" onclick="event.preventDefault();
		                    	document.getElementById('logout-form').submit();"
		                    >Cerrar Sesión</a>
		               	</li>
					@endguest
				</ul>
			</div>
		</div>
	</nav>
	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		@csrf
	</form>