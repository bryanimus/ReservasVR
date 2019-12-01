<!DOCTYPE html>
<html>
<head>
</head>
<body>
		<table>
			<thead>
				<tr>
					<td>Num Reserva</td>
					<td>Nombre Reserva</td>
					<td>Centro de Convenciones</td>
					<td>Usuario Encargado</td>
					<td>Fecha/Hora Reunión</td>
					<td>Estado</td>
				</tr>
			</thead>
			<tbody>
				@forelse($reserves as $reserve)
					<tr>
						<td>{{ $reserve->ID_RESERVA }}</td>
						<td>{{ $reserve->NOMBRE_RESERVA }}</td>
						<td>{{ $reserve->CONVENCION }}</td>
						<td>{{ $reserve->USUARIO_ENCARGADO }}</td>
						<td>{{ $reserve->FECHA_REUNION }} {{ $reserve->HORA_INICIO }} a {{ $reserve->HORA_FIN }}</td>
						<td>{{ $reserve->ESTADO_DESC }}</td>
					</tr>
				@empty
				@endforelse
			</tbody>
		</table>
</body>
</html>