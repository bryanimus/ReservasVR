@extends('layout')

@section('title','Ministerios')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<form class="bg-white py-3 px-4 shadow rounded"
				method="POST" action="{{ route('ministry.store') }}">
				<h1 class="display-5">Nuevo Ministerio</h1>
				<hr>
				@include('ministries._form',
					[
						'btnText' => 'Guardar'
					]
				)
		</form>
		</div>
	</div>
</div>
@endsection