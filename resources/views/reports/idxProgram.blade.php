<!DOCTYPE html>
<html>
<head>
	<title>Programación</title>
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
		<center><img src="{{ asset('img/Logotipo.png') }}" alt="Gestion Reservas"><h1>Programación</h1></center>
		<br>
		<center>Filtrado por: {{ $fecha_inicio }} al {{ $fecha_final }}</center>
		@if (!is_null($convention))
			<br><center>Centro de Convenciones: {{ $conventionDESC->nombre }}</center>
		@endif
		<hr>

		@forelse($reserves as $reserve)
			<u><h2>Fecha Reservación: {{ $reserve->FECHA_REUNION }} </h2><br></u>
			<p>
				<h3>{{ $reserve->HORA_INICIO . ' - ' . $reserve->HORA_FIN}} : {{ $reserve->NOMBRE_RESERVA }}</h3> <br>
				<strong>Encargado:</strong> {{ $reserve->USUARIO_ENCARGADO }} <br>
				<strong>Centro de Convenciones:</strong> {{ $reserve->CONVENCION }} <br>
				<strong>Propósito:</strong> {{ $reserve->PROPOSITO }} <br>
				<strong>Salones:</strong><br>
				@foreach($reserve->SALONES as $salones)
					<tab1>{{ $salones->SALON }}</tab1><br>
				@endforeach
				<strong>Montaje:</strong> {{ $reserve->MONTAJE }} <br>
				@if($reserve->MANTELERIA != '')
					<strong>Manteleria:</strong> {{ $reserve->MANTELERIA }} <br>
				@endif
				@if($reserve->MUSICAL != '')
					<strong>Musical:</strong> {{ $reserve->MUSICAL }} <br>
				@endif
				@if(count($reserve->RECURSOS))
					<strong>Recursos:</strong><br>
					@foreach($reserve->RECURSOS as $recursos)
						@if($recursos->TIPO == 6)
							<tab1>{{ $recursos->CANTIDAD }} - {{ $recursos->RECURSO }} ({{ $recursos->RECURSO_DESC }})</tab1><br>
						@else
							<tab1>{{ $recursos->CANTIDAD }} - {{ $recursos->RECURSO }} </tab1><br>
						@endif
					@endforeach
				@endif
			</p>
			<hr>
		@empty
		@endforelse
	</form>
</body>
</html>