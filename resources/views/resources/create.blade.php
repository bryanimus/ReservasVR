@extends('layout')

@section('title','Recursos')
@section('scripts')
	<script type="text/javascript" defer>
		var fillValue;

		fillValue = function(obj){
			document.getElementById('tipo').value = obj.value;
		}
	</script>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<form class="bg-white py-3 px-4 shadow rounded"
				method="POST" action="{{ route('resource.store') }}">
				<h1 class="display-5">Nuevo Recurso</h1>
				<hr>
				@include('resources._form',
					[
						'btnText' => 'Guardar'
					]
				)
		</form>
		</div>
	</div>
</div>
@endsection