@extends('layout')

@section('title','Home')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-lg-6">
			<h1 class="display-4 text-primary">Reservaciones Vida Real</h1>
			<p>En el presente sistema, usted podrá gestionar los distintos eventos de la Iglesia Vida Real</p>
		</div>
		<div class="col-12 col-lg-6">
			<img class="img-fluid mb-4" src="{{ asset('img/Reserva.svg') }}" alt="Gestion Reservas">
		</div>
	</div>
</div>
@endsection
</html>