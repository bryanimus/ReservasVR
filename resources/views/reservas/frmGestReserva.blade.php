@extends('layout')

@section('title','Gestionar Reserva')

@section('scripts')
	<script type="text/javascript">
		var validateForm;

		validateForm = function (){
			return false;
		}
	</script>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-10 mx-auto">
			<form id="frmGestReserva" class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{ route('reserva.storeGestReserva') }}">
				@csrf

				<button id="btnGuardar" type="button" class="btn btn-primary btn-lg btn-block" onclick="validateForm();">Aceptar</button>
			</form>
		</div>
	</div>
</div>
@endsection