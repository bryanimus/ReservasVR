@extends('layout')

@section('title','Departamentos')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<form class="bg-white py-3 px-4 shadow rounded"
				method="POST" action="{{ route('department.update', $department) }}">
				@method('PATCH')
				<h1 class="display-4">Editar Departamento</h1>
				<hr>
				@include('departments._form',
					[
						'btnText' => 'Actualizar'
					]
				)
			</form>
		</div>
	</div>
</div>
@endsection