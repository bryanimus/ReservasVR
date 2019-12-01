@extends('layout')

@section('title','Usuarios')
@section('scripts')
	<script type="text/javascript" defer>
		var checkRadio;
		var saveID;

		saveID = function(obj){
			document.getElementById('valType').value = obj.value;
		}

		checkRadio = function(type){
			var i;
			switch(type){
				case "1":
					document.getElementById('ministry_id').style.display='block';
					document.getElementById('department_id').style.display='none';
					document.getElementById('typeUser1').checked = true;
					document.getElementById('department_id').selectedIndex = 0;
					document.getElementById('opcType').value = '1';
					document.getElementById('department_id').classList.remove('is-invalid');
					for (i = 0; i < document.getElementById('ministry_id').options.length; i++){
						if (document.getElementById('valType').value == document.getElementById('ministry_id').options[i].value){
							document.getElementById('ministry_id').selectedIndex = i;
							break;
						}}
					break;
				case "2":
					document.getElementById('ministry_id').style.display='none';
					document.getElementById('department_id').style.display='block';
					document.getElementById('typeUser2').checked = true;
					document.getElementById('ministry_id').selectedIndex = 0;
					document.getElementById('opcType').value = '2';
					document.getElementById('ministry_id').classList.remove('is-invalid');
					for (i = 0; i < document.getElementById('department_id').options.length; i++)
						if (document.getElementById('valType').value == document.getElementById('department_id').options[i].value){
							document.getElementById('department_id').selectedIndex = i;
							break;
						}
					break;
			}
		}

		window.onload = function (){
			checkRadio(document.getElementById('opcType').value);
		}
	</script>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-6 mx-auto">
			<form class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{ route('user.update', $user) }}">
				@method('PATCH')
				<h1 class="display-5">Editar Usuario</h1>
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