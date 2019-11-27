@extends('layout')

@section('title','Reservar Reserva')

@section('scripts')
	<script type="text/javascript">
		var validateForm;
		var addRowToTable;
		var deleteRow;
		var showDate;

		deleteRow = function(index, tblID){
			var tbl = document.getElementById(tblID);
			tbl.deleteRow(index);
		}

		addRowToTable = function(tblID, objCombo, lblTxt, idRow, txtRow){
			var table = document.getElementById(tblID);
			var lastRow = table.rows.length;
			var i;

			if (objCombo.value == ""){
				alert('Debe Seleccionar ' + lblTxt);
				objCombo.focus();
				return false;
			}
			for (i = 1; i < table.rows.length; i++) {
				if (table.rows[i].cells[0].firstChild.value == objCombo.value){
					alert(lblTxt + ' ya existente');
					objCombo.focus();
					return false;
				}
			}
			var row = table.insertRow(lastRow);

			var cell0 = row.insertCell(0);
			var idReq = document.createElement('input');
			idReq.id = idRow + '[]';
			idReq.setAttribute('type', 'text');
			idReq.setAttribute('name', idRow + '[]');
			idReq.setAttribute('value', objCombo.value);
			idReq.style.border = '1px solid #fff';
			idReq.readOnly = 'true';
			cell0.style.display='none';
			cell0.style.width='0%';
			cell0.appendChild(idReq);

			var cell1 = row.insertCell(1);
			var delBtn = document.createElement('input');
			delBtn.id = 'Del' + idRow + lastRow;
			delBtn.setAttribute('type', 'button');
			delBtn.setAttribute('name', 'Del' + idRow + lastRow);
			delBtn.className = 'btn btn-danger btn-xs';
			delBtn.setAttribute('value', 'X');
			delBtn.onclick = function () {
				deleteRow(this.parentNode.parentNode.rowIndex, tblID);
			};
			cell1.style.width='10%';
			cell1.appendChild(delBtn);

			var cell2 = row.insertCell(2);
			var txtReq = document.createElement('label');
			txtReq.innerText = objCombo.options[objCombo.selectedIndex].text;
			cell2.style.width='80%';
			cell2.appendChild(txtReq);

			objCombo.selectedIndex = 0;
			objCombo.classList.remove('is-invalid');
		}

		showDate = function(check){
			var styleDiv = (check) ? 'block' : 'none';

			document.getElementById('fechaDiv').style.display = styleDiv;
			document.getElementById('horaIDiv').style.display = styleDiv;
			document.getElementById('horaFDiv').style.display = styleDiv;
			$(".datepicker").datepicker("setDate", "");
			document.getElementById('hora_inicio').value = '';
			document.getElementById('hora_fin').value = '';
			document.getElementById('fecha_reunion').classList.remove('is-invalid');
			document.getElementById('hora_inicio').classList.remove('is-invalid');
			document.getElementById('hora_fin').classList.remove('is-invalid');
		}

		validateForm = function (){
			var blnContinue = true;

			document.getElementById('salon').classList.remove('is-invalid'); document.getElementById('fecha_reunion').classList.remove('is-invalid');
			document.getElementById('hora_inicio').classList.remove('is-invalid'); document.getElementById('hora_fin').classList.remove('is-invalid');
			document.getElementById('althorario').style.display = 'none';

			if (document.getElementById('tblsalon').rows.length == 1){ document.getElementById('salon').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('chgDate').checked){
				if (document.getElementById('fecha_reunion').value.trim() == ''){ document.getElementById('fecha_reunion').classList.add('is-invalid'); blnContinue = false;}
				if (document.getElementById('hora_inicio').value.trim() == ''){ document.getElementById('hora_inicio').classList.add('is-invalid'); blnContinue = false;}
				if (document.getElementById('hora_fin').value.trim() == ''){ document.getElementById('hora_fin').classList.add('is-invalid'); blnContinue = false;}
				if (document.getElementById('hora_inicio').value.trim() != '' && document.getElementById('hora_fin').value.trim() != '') {
					var horaInicio = parseInt(document.getElementById('hora_inicio').value.trim().replace(":",""));
					var horaFin = parseInt(document.getElementById('hora_fin').value.trim().replace(":",""));

					if (horaInicio >= horaFin) {document.getElementById('althorario').style.display = 'block';  blnContinue=false; }
				}
			}

			if (blnContinue)
				frmGestReserva.submit();
			else
				alert('Favor Completar Información Requerida');
		}
	</script>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-10 mx-auto">
			<form id="frmGestReserva" class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{ route('reserva.storeResReserva', $reserva->ID_RESERVA) }}">
				@method('PATCH')
				@csrf

				<h2><center>Reservación de Reserva</center></h2>
				<hr>
				@include('reservas._infoSolicitud')
				<div class="form-row">
					<div class="form-group col-md-3">
						<label><strong>Fecha Aprobación</strong></label> <br>
						<label>{{ $reserva->FECHA_APRUEBA }}</label>
					</div>
					<div class="form-group col-md-3">
						<label><strong>Usuario que Aprobó</strong></label> <br>
						<label>{{ $reserva->USUARIO_APRUEBA}}</label>
					</div>
					<div class="form-group col-md-6">
						<label><strong>Observaciones Aprobación</strong></label> <br>
						<label>{{ $reserva->OBSERVACION_APRUEBA }}</label>
					</div>
				</div>

				<hr>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="salon">Salones <strong>(*)</strong></label>
						<select class ="form-control" id="salon" name="salon">
							<option value="">Seleccione Salón</option>
							@foreach ($salones as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-1">
						<label for="addsalon"></label>
						<button id="addsalon" type="button" class="btn btn-info btn-xs"
							onclick="addRowToTable('tblsalon', frmGestReserva.salon, 'Salon', 'idSalon', 'txtSalon'); return false;">Agregar</button>
					</div>
				</div>
				<div class="form-group overflow-auto" style="height: 200px;">
					<table class="table table-sm table-bordered" id ="tblsalon" name ="tblsalon">
						<thead class="thead-light"><tr><th style="display:none;"></th><th colspan="2"><center>Salón</center></th></tr></thead>
					</table>
				</div>

				<div class="form-row">
					<div class="form-group col-md-3">
						<label for="privEvent">El Evento Será <strong>(*)</strong></label>
						<br>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="privEvent" id="PrivEvent1" value="1" checked>
							<label class="form-check-label" for="PrivEvent1">Privado</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="privEvent" id="PrivEvent2" value="2">
							<label class="form-check-label" for="PrivEvent2">Público</label>
						</div>
					</div>
					<div class="form-group col-md-3">
						<br>
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="chgDate" name="chgDate" onchange="showDate(this.checked);">
							<label class="form-check-label" for="chgDate">Cambiar Fecha Evento?</label>
						</div>
					</div>
					<div class="form-group col-md-2">
						<div id="fechaDiv" style="display:none;">
							<label for="fecha_reunion">Fecha <strong>(*)</strong></label>
	                        <div class="input-group">
	                            <input type="text" class="form-control datepicker" name="fecha_reunion" id="fecha_reunion" readonly="true">
	                            <div class="input-group-addon">
	                                <span class="glyphicon glyphicon-th"></span>
	                            </div>
	                        </div>
                    	</div>
					</div>
					<div class="form-group col-md-2">
						<div id="horaIDiv" style="display:none;">
							<label for="hora_inicio">Hora Inicio <strong>(*)</strong></label>
							<input id="hora_inicio" name="hora_inicio" id ="hora_inicio" type="time" class="form-control" onfocusout="removeClassTXT(this);">
							<span id="althorario" class="invalid-feedback" style="display:none;" role="alert"><strong>El campo Hora Inicio debe ser menor a Hora Fin</strong></span>
						</div>
					</div>
					<div class="form-group col-md-2">
						<div id="horaFDiv" style="display:none;">
							<label for="hora_fin">Hora Fin <strong>(*)</strong></label>
							<input id="hora_fin" name="hora_fin" id ="hora_fin" type="time" class="form-control" onfocusout="removeClassTXT(this);">
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="observacion_reserva">Observaciones Reserva</label>
					<textarea class ="form-control" id="observacion_reserva" name="observacion_reserva" onfocusout="remplazarEspeciales(this);" onkeypress="ValidaCaracter(event);"></textarea>
				</div>

				<button id="btnGuardar" type="button" class="btn btn-primary btn-lg btn-block" onclick="validateForm();">Reservar</button>
				<a class="btn btn-link btn-block" href="{{ route('reserva.resIndex') }}">Cancelar</a>
			</form>
		</div>
	</div>
</div>
@endsection