@extends('layout')

@section('title','Mis Reservas')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-5 mb-0">Mis Reservas</h1>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<td>Num Reserva</td>
				<td>Nombre</td>
				<td>Centro de Convención</td>
				<td>Estado</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			@forelse($reserves as $reserve)
				<tr>
					<td>{{ $reserve->id }}</td>
					<td>{{ $reserve->nombre }}</td>
					<td>{{ $reserve->convention->nombre }}</td>
					<td>{{ $reserve->descEstado()}}</td>
					<td>
						@if ($reserve->estado == 1)
							<form style="display:inline" method="POST" action="{{ route('reserva.delMiReserva', $reserve) }}">
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
	{{ $reserves->links() }}
</div>
@endsection