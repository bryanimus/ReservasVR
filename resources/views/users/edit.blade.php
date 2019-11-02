@extends('layout')

@section('title','Usuarios')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{ route('user.update', $user) }}">
				@method('PATCH')
				<h1 class="display-4">Editar Usuario</h1>
				<hr>
				@include('users._form',
					[
						'btnText' => 'Actualizar'
					]
				)
			</form>
		</div>
	</div>
</div>
@endsection