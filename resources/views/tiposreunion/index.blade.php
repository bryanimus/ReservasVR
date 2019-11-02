@extends('layout')

@section('title','Tipos de Reuniones')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-4 mb-0">Tipos de Reuniones</h1>
		@auth
			<a class="btn btn-primary" href="{{ route('tiporeunion.create') }}">Crear</a>
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
			@forelse($tiposreunion as $tiporeunion)
				<tr>
					<td>{{ $tiporeunion->nombre}}</td>
					<td>
						<a class="btn btn-info btn-xs" href="{{ route('tiporeunion.edit', $tiporeunion) }}">Editar</a>
						<form style="display:inline" method="POST" action="{{ route('tiporeunion.destroy', $tiporeunion) }}">
							@csrf @method('DELETE')
							<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
						</form>
					</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
	{{ $tiposreunion->links() }}
</div>
@endsection