@extends('layout')

@section('title','Editar Centro de Convencion')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<form class="bg-white py-3 px-4 shadow rounded"
				method="POST" action="{{ route('tiporeunion.store') }}">
				<h1 class="display-4">Nuevo Tipo de Reunión</h1>
				<hr>
				@include('tiposreunion._form',
					[
						'btnText' => 'Guardar'
					]
				)
		</form>
		</div>
	</div>
</div>
@endsection