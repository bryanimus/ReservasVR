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
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropDownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Parametrización</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="{{ route('convention.index') }}">Centros de Convenciones</a>
								<a class="dropdown-item" href="{{ route('ministry.index') }}">Ministerios</a>
								<a class="dropdown-item" href="{{ route('salon.index') }}">Salones</a>
								<a class="dropdown-item" href="{{ route('tiporeunion.index') }}">Tipos de Reuniones</a>
								<a class="dropdown-item" href="{{ route('resource.index') }}">Recursos</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropDownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Operaciones</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="{{ route('reserva.Init') }}">Reservar Evento</a>
								<a class="dropdown-item" href="{{ route('reserva.Index') }}">Gestionar Eventos</a>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="navbarDropDownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Seguridad</a>
							<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
								<a class="dropdown-item" href="{{ route('user.index') }}">Usuarios</a>
								<a class="dropdown-item" href="{{ route('role.index') }}">Roles</a>
							</div>
						</li>
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