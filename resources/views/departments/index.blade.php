@extends('layout')

@section('title','Departamentos')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-5 mb-0">Departamentos</h1>
		@auth
			<a class="btn btn-primary" href="{{ route('department.create') }}">Crear</a>
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
			@forelse($departments as $department)
				<tr>
					<td>{{ $department->nombre}}</td>
					<td>
						@if ($department->convention_id)
							{{ $department->convention->nombre }}
						@endif
					</td>
					<td>
						<a class="btn btn-info btn-xs" href="{{ route('department.edit', $department) }}">Editar</a>
						<form style="display:inline" method="POST" action="{{ route('department.updateState', $department) }}">
							@csrf @method('PATCH')
							<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
						</form>
					</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
	{{ $departments->links() }}
</div>
@endsection