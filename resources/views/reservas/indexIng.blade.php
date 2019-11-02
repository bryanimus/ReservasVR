@extends('layout')

@section('title','Mis Reservas')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-4 mb-0">Mis Reservas</h1>
		@auth
			<a class="btn btn-primary" href="{{ route('reservaIng.create') }}">Crear Reserva</a>
		@endauth
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<td>Codigo</td>
				<td>Centro Convencion</td>
				<td>Salon</td>
				<td>Fecha</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			@forelse($misreservas as $mireserva)
				<tr>
					<td>{{ $mireserva->codigoReserva }}</td>
					<td>
						@if ($mireserva->convention_id)
							{{ $mireserva->convention->nombre }}
						@endif
					</td>
					<td>
						@if ($mireserva->salon_id)
							{{ $mireserva->salon->nombre }}
						@endif
					</td>
					<td></td>
					<td>

					</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
	{{ $misreservas->links() }}
</div>
@endsection