@extends('layout')

@section('title','Recursos')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-4 mb-0">Recursos</h1>
		@auth
			<a class="btn btn-primary" href="{{ route('resource.create') }}">Crear</a>
		@endauth
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<td>Nombre</td>
				<td>Tipo</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			@forelse($resources as $resource)
				<tr>
					<td>{{ $resource->nombre}}</td>
					<td>{{ $resource->tipoNombre($resource)}}</td>
					<td>
						<a class="btn btn-info btn-xs" href="{{ route('resource.edit', $resource) }}">Editar</a>
						<form style="display:inline" method="POST" action="{{ route('resource.updateState', $resource) }}">
							@csrf @method('PATCH')
							<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
						</form>
					</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
	{{ $resources->links() }}
</div>
@endsection