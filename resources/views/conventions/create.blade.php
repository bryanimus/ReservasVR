@extends('layout')

@section('title','Centros de Convenciones')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<form class="bg-white py-3 px-4 shadow rounded"
				method="POST" action="{{ route('convention.store') }}">
				<h1 class="display-4">Nuevo Centro de Convención</h1>
				<hr>
				@include('conventions._form',
					[
						'btnText' => 'Guardar'
					]
				)
		</form>
		</div>
	</div>
</div>
@endsection