@extends('layout')

@section('title','Ministerios')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-4 mb-0">Ministerios</h1>
		@auth
			<a class="btn btn-primary" href="{{ route('ministry.create') }}">Crear</a>
		@endauth
	</div>

	<table class="table table-striped">
		<thead>
			<tr>
				<td>Nombre</td>
				<td>Centro Convención</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			@forelse($ministries as $ministry)
				<tr>
					<td>{{ $ministry->nombre}}</td>
					<td>
						@if ($ministry->convention_id)
							{{ $ministry->convention->nombre }}
						@endif
					</td>
					<td>
						<a class="btn btn-info btn-xs" href="{{ route('ministry.edit', $ministry->id) }}">Editar</a>
						<form style="display:inline" method="POST" action="{{ route('ministry.updateState', $ministry) }}">
							@csrf @method('PATCH')
							<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
						</form>
					</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
	{{ $ministries->links() }}
</div>
@endsection