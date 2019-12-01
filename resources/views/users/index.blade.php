@extends('layout')

@section('title','Usuarios')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-5 mb-0">Usuarios</h1>
		@auth
			<a class="btn btn-primary" href="{{ route('user.create') }}">Crear Usuario</a>
		@endauth
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<td>Nombre</td>
				<td>Rol</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			@forelse($users as $user)
				<tr>
					<td>{{ $user->name }}</td>
					<td>
						@if ($user->role_id)
							{{ $user->role->nombre }}
						@endif
					</td>
					<td>
						<a class="btn btn-info btn-xs" href="{{ route('user.edit', $user->id) }}">Editar</a>
						@if(auth()->user()->id != $user->id)
							<form style="display:inline" method="POST" action="{{ route('user.updateState', $user) }}">
								@csrf @method('PATCH')
								<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
							</form>
						@endif
					</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
	{{ $users->links() }}
</div>
@endsection