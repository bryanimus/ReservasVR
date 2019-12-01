@extends('layout')

@section('title','Aprobación de Eventos')

@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-5 mb-0">Aprobación de Reservas</h1>
	</div>
	<table class="table table-striped">
		<thead>
			<tr>
				<td>Num Reserva</td>
				<td>Nombre</td>
				<td>Centro de Convención</td>
				<td>Usuario Encargado</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			@forelse($reserves as $reserve)
				<tr>
					<td>{{ $reserve->id }}</td>
					<td>{{ $reserve->nombre }}</td>
					<td>{{ $reserve->convention->nombre }}</td>
					<td>{{ $reserve->usuario($reserve->user_encargado_id)}}</td>
					<td>
						<a class="btn btn-info btn-xs" href="{{ route('reserva.Show', $reserve->id) }}">Gestionar</a>
					</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
	{{ $reserves->links() }}
</div>
@endsection