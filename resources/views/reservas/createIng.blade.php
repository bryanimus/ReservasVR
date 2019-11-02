@extends('layout')

@section('title','Crear Reserva')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<form class="bg-white py-3 px-4 shadow rounded"
				method="POST" action="{{ route('reservaIng.store') }}">
				<h1 class="display-4">Nueva Reserva</h1>
				<hr>
				@include('reservas._form',
					[
						'btnText' => 'Guardar'
					]
				)
		</form>
		</div>
	</div>
</div>
@endsection