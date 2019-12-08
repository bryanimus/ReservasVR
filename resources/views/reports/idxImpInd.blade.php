<!DOCTYPE html>
<html>
<head>
	<title>Impresión Individual</title>
	<style type="text/css">
		br {
            display: block; /* makes it have a width */
            content: ""; /* clears default height */
            margin-top: 0; /* change this to whatever height you want it */
		}
		h1, h2, h3, h4, h5, h6{
		  margin-top:20px;
		  margin-bottom:10px;
		}
		tab1 { padding-left: 4em; }
	</style>
</head>
<body>
	<form>
		<center><img src="{{ asset('img/Logotipo.png') }}" alt="Gestion Reservas"><h1>Impresión Reserva: {{ $ID }}</h1></center>
		<hr>
		@if(!is_null($reserves))
			<u><h2>Fecha Reservación: {{ $reserves->FECHA_REUNION }} </h2><br></u>
			<p>
				<h3>{{ $reserves->HORA_INICIO . ' - ' . $reserves->HORA_FIN}} : {{ $reserves->NOMBRE_RESERVA }}</h3> <br>
				<strong>Encargado:</strong> {{ $reserves->USUARIO_ENCARGADO }} <br>
				<strong>Centro de Convenciones:</strong> {{ $reserves->CONVENCION }} <br>
				<strong>Propósito:</strong> {{ $reserves->PROPOSITO }} <br>
				<strong>Salones:</strong><br>
				@foreach($reserves->SALONES as $salones)
					<tab1>{{ $salones->SALON }}</tab1><br>
				@endforeach
				<strong>Montaje:</strong> {{ $reserves->MONTAJE }} <br>
				@if($reserves->MANTELERIA != '')
					<strong>Manteleria:</strong> {{ $reserves->MANTELERIA }} <br>
				@endif
				@if($reserves->MUSICAL != '')
					<strong>Musical:</strong> {{ $reserves->MUSICAL }} <br>
				@endif
				@if(count($reserves->RECURSOS))
					<strong>Recursos:</strong><br>
					@foreach($reserves->RECURSOS as $recursos)
						@if($recursos->TIPO == 6)
							<tab1>{{ $recursos->CANTIDAD }} - {{ $recursos->RECURSO }} ({{ $recursos->RECURSO_DESC }})</tab1><br>
						@else
							<tab1>{{ $recursos->CANTIDAD }} - {{ $recursos->RECURSO }} </tab1><br>
						@endif
					@endforeach
				@endif
			</p>
		@endif
	</form>
</body>
</html>