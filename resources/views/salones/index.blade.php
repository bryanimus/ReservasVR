@extends('layout')

@section('title','Salones')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-4 mb-0">Salones</h1>
		@auth
			<a class="btn btn-primary" href="{{ route('salon.create') }}">Crear</a>
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
			@forelse($salones as $salon)
				<tr>
					<td>{{ $salon->nombre }}</td>
					<td>
						@if ($salon->convention_id)
							{{ $salon->convention->nombre }}
						@endif
					</td>
					<td>
						<a class="btn btn-info btn-xs" href="{{ route('salon.edit', $salon->id) }}">Editar</a>
						<form style="display:inline" method="POST" action="{{ route('salon.updateState', $salon) }}">
							@csrf @method('PATCH')
							<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
						</form>
					</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
	{{ $salones->links() }}
</div>
@endsection