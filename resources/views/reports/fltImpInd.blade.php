@extends('layout')

@section('title','Impresión Individual')
@section('scripts')
	<script type="text/javascript" defer>
		var validateForm;

		validateForm = function(){
			var blnContinue = true;

			document.getElementById('reserve_id').classList.remove('is-invalid'); document.getElementById('altreserva').style.display = 'none';

			if (document.getElementById('reserve_id').value.trim() == ''){ document.getElementById('reserve_id').classList.add('is-invalid'); blnContinue = false;}
			if (isNaN(parseInt(document.getElementById('reserve_id').value.trim())) && document.getElementById('reserve_id').value.trim() != '') {
				document.getElementById('altreserva').style.display = 'block'; blnContinue = false;}

			if (blnContinue)
				fltImpInd.submit();
			else
				alert('Favor Completar Información Requerida');
		}
	</script>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-10 mx-auto">
			<form id="fltImpInd" class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{ route('reporte.showimpresionInd') }}">
				@csrf
				<h2>Impresión Individual</h2>
				<hr>
				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="reserve_id">ID Reserva</label>
						<input class="form-control" id="reserve_id" type="text" name="reserve_id" onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);">
						<span id="altreserva" class="invalid-feedback" style="display:none;" role="alert"><strong>El campo ID Reserva debe ser numérico</strong></span>
					</div>
				</div>
				<button id="btnFilter" type="button" class="btn btn-primary btn-lg btn-block" onclick="validateForm();">Consultar</button>
			</form>
		</div>
	</div>
</div>
@endsection