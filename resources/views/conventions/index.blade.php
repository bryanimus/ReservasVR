@extends('layout')

@section('title','Centros de Convenciones')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-5 mb-0">Centros de Convenciones</h1>
		@auth
			<a class="btn btn-primary" href="{{ route('convention.create') }}">Crear</a>
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
			@forelse($conventions as $convention)
				<tr>
					<td>{{ $convention->nombre }}</td>
					<td>
						<a class="btn btn-info btn-xs" href="{{ route('convention.edit', $convention->id) }}">Editar</a>
						<form style="display:inline" method="POST" action="{{ route('convention.updateState', $convention) }}">
							@csrf @method('PATCH')
							<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
						</form>
					</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
	{{ $conventions->links() }}
</div>
@endsection