@extends('layout')

@section('title','Roles')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-4 mb-0">Roles</h1>
		@auth
			<a class="btn btn-primary" href="{{ route('role.create') }}">Crear</a>
		@endauth
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<td>Nombre</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			@forelse($roles as $role)
				<tr>
					<td>{{ $role->nombre}}</td>
					<td>
						<a class="btn btn-info btn-xs" href="{{ route('role.edit', $role) }}">Editar</a>
						<form style="display:inline" method="POST" action="{{ route('role.destroy', $role) }}">
							@csrf @method('DELETE')
							<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
						</form>
					</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
	{{ $roles->links() }}
</div>
@endsection