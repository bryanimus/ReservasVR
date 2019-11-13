@extends('layout')

@section('title','Reservar')

@section('scripts')
	<script type="text/javascript" defer>
		var addMinistries;
		var minMaxPersons;
		var addRowToTable;
		var deleteRow;
		var validateForm;

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
			cell1.appendChild(delBtn);

			var cell2 = row.insertCell(2);
			var txtReq = document.createElement('input');
			txtReq.id = txtRow + '[]';
			txtReq.setAttribute('type', 'text');
			txtReq.setAttribute('name', txtRow + '[]');
			txtReq.setAttribute('value', objCombo.options[objCombo.selectedIndex].text);
			txtReq.style.border = '1px solid #fff';
			txtReq.readOnly = 'true';
			cell2.appendChild(txtReq);

			objCombo.selectedIndex = 0;
		}

		addMinistries = function(){
			var idConvention = document.getElementById('convention_id').value;
			var objMinistry = document.getElementById('ministry_id');
			var option;

			$.get('/reserva/getMinistry/' + idConvention).done(
				function(response){
					while (objMinistry.length > 1)
						objMinistry.remove(1);
					for (var i = 0; i < response.length; i++){
						option = document.createElement('option');
						option.text = response[i].nombre;
						option.value = response[i].id;
						objMinistry.add(option);
					}
			})
		}

		minMaxPersons = function(){
			var indexSizeReunion = document.getElementById('tamano_reunion').value;
			switch(indexSizeReunion){
				case "1":
					document.getElementById('cantidad_persona').min=6;	document.getElementById('cantidad_persona').max=70;	document.getElementById('cantidad_persona').value=6;
					break;
				case "2":
					document.getElementById('cantidad_persona').min=71;	document.getElementById('cantidad_persona').max=230; document.getElementById('cantidad_persona').value=71;
					break;
				case "3":
					document.getElementById('cantidad_persona').min=300; document.getElementById('cantidad_persona').max=800; document.getElementById('cantidad_persona').value=300;
					break;
			}
		}

		validateForm = function (){
			var blnContinue = true;
			document.getElementById('convention_id').classList.remove('is-invalid'); document.getElementById('tamano_reunion').classList.remove('is-invalid');
			document.getElementById('ministry_id').classList.remove('is-invalid'); document.getElementById('user_encargado_id').classList.remove('is-invalid');
			document.getElementById('costo_evento').classList.remove('is-invalid');
			document.getElementById('proposito').classList.remove('is-invalid'); document.getElementById('fecha_reunion').classList.remove('is-invalid');
			document.getElementById('hora_inicio').classList.remove('is-invalid'); document.getElementById('hora_fin').classList.remove('is-invalid');
			document.getElementById('reuniontype_id').classList.remove('is-invalid'); document.getElementById('cantidad_persona').classList.remove('is-invalid');
			document.getElementById('montaje_id').classList.remove('is-invalid'); document.getElementById('althorario').style.display = 'none';

			if (document.getElementById('convention_id').selectedIndex == 0){ document.getElementById('convention_id').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('tamano_reunion').selectedIndex == 0){ document.getElementById('tamano_reunion').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('ministry_id').selectedIndex == 0){ document.getElementById('ministry_id').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('user_encargado_id').selectedIndex == 0){ document.getElementById('user_encargado_id').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('costo_evento').selectedIndex == 0){ document.getElementById('costo_evento').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('proposito').value.trim() == ''){ document.getElementById('proposito').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('fecha_reunion').value.trim() == ''){ document.getElementById('fecha_reunion').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('hora_inicio').value.trim() == ''){ document.getElementById('hora_inicio').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('hora_fin').value.trim() == ''){ document.getElementById('hora_fin').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('hora_inicio').value.trim() != '' && document.getElementById('hora_fin').value.trim() != '') {
				var horaInicio = parseInt(document.getElementById('hora_inicio').value.trim().replace(":",""));
				var horaFin = parseInt(document.getElementById('hora_fin').value.trim().replace(":",""));

				if (horaInicio >= horaFin) {
					document.getElementById('althorario').style.display = 'block';  document.getElementById('hora_inicio').classList.add('is-invalid');
					document.getElementById('hora_fin').classList.add('is-invalid'); blnContinue=false;
				}
			}
			if (document.getElementById('reuniontype_id').selectedIndex == 0){ document.getElementById('reuniontype_id').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('cantidad_persona').value.trim() == ''){ document.getElementById('cantidad_persona').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('montaje_id').selectedIndex == 0){ document.getElementById('montaje_id').classList.add('is-invalid'); blnContinue = false;}

			if (blnContinue)
				frmReserva.submit();
			else
				alert('Favor Completar Información Requerida');
		}
	</script>
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-12 col-sm-10 col-lg-10 mx-auto">
			<form id="frmReserva" class="bg-white py-3 px-4 shadow rounded" method="POST" action="{{ route('reserva.store') }}">
				@csrf
				<h2>Información General</h2>
				<hr>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="convention">Centro de Convención <strong>(*)</strong></label>
						<select class ="form-control" name="convention_id" id= "convention_id"
							onChange="addMinistries();removeClassCmb(this);">
							<option value="">Seleccione Centro de Convencion</option>
							@foreach ($conventions as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-6">
						<label for="tamano_reunion">Tamaño de la Reunión <strong>(*)</strong></label>
						<select class ="form-control" name="tamano_reunion" id="tamano_reunion" onChange="minMaxPersons();removeClassCmb(this);">
							<option value="">Seleccione Cantidad de Personas</option>
								<option value="1">de 6 a 70 personas máximo</option>
								<option value="2">de 71 a 230 personas máximo</option>
								<option value="3">de 300 a 800 personas máximo</option>
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="ministry_id">Ministerio <strong>(*)</strong></label>
						<select class ="form-control" name="ministry_id" id= "ministry_id" onchange="removeClassCmb(this);">
							<option value="">Seleccione Ministerio</option>
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="user_encargado_id">Encargado del Evento <strong>(*)</strong></label>
						<select class ="form-control" id="user_encargado_id" name="user_encargado_id" onchange="removeClassCmb(this);">
							<option value="">Seleccione Encargado del Evento</option>
							@foreach ($users as $id => $name)
								<option value="{{ $id }}">{{ $name }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="costo_evento">Costo del Evento <strong>(*)</strong></label>
						<select class ="form-control" name="costo_evento" id= "costo_evento" onchange="removeClassCmb(this);">
							<option value="">Seleccione Costo del Evento</option>
							<option value="1">Presupuesto</option>
							<option value="2">Pago Directo</option>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label for="proposito">Proposito de la Reunión <strong>(*)</strong></label>
					<textarea class ="form-control" id="proposito" name="proposito" onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);"></textarea>
				</div>

				<h2>Información del Evento</h2>
				<hr>

				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="fecha_reunion">Fecha <strong>(*)</strong></label>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" name="fecha_reunion" id="fecha_reunion" readonly="true">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
					</div>
					<div class="form-group col-md-4">
						<label for="hora_inicio">Hora Inicio <strong>(*)</strong></label>
						<input id="hora_inicio" name="hora_inicio" id ="hora_inicio" type="time" class="form-control" onfocusout="removeClassTXT(this);">
						<span id="althorario" class="invalid-feedback" style="display:none;" role="alert"><strong>El campo Hora Inicio debe ser menor a Hora Fin</strong></span>
					</div>
					<div class="form-group col-md-4">
						<label for="hora_fin">Hora Fin <strong>(*)</strong></label>
						<input id="hora_fin" name="hora_fin" id ="hora_fin" type="time" class="form-control" onfocusout="removeClassTXT(this);">
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="reuniontype_id">Tipo de Reunión <strong>(*)</strong></label>
						<select class ="form-control" id="reuniontype_id" name="reuniontype_id" onchange="removeClassCmb(this);">
							<option value="">Seleccione Tipo de Reunión</option>
							@foreach ($reuniontypes as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-6">
						<label for="cantidad_persona">Cantidad de Personas <strong>(*)</strong></label>
						<input class="form-control" type="number" name="cantidad_persona" id="cantidad_persona" min="6" max="800" value="6">
					</div>
				</div>

				<h2>Recursos</h2>
				<hr>

				<div class="form-row">
					<div class="form-group col-md-4">
						<label for="montaje_id">Tipo de Montaje <strong>(*)</strong></label>
						<select class ="form-control" id="montaje_id" name="montaje_id" onchange="removeClassCmb(this);">
							<option value="">Seleccione Tipo de Montaje</option>
							@foreach ($montajes as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="manteleria_id">Tipo de Manteleria</label>
						<select class ="form-control" id="manteleria_id" name="manteleria_id">
							<option value="">Seleccione Tipo de Manteleria</option>
							@foreach ($mantelerias as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-4">
						<label for="musical_id">Musical</label>
						<select class ="form-control" id="musical_id" name="musical_id">
							<option value="">Seleccione Música</option>
							@foreach ($musicas as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="req_tecnico">Requerimiento Técnico</label>
						<select class ="form-control" id="req_tecnico" name="req_tecnico">
							<option value="">Seleccione Requerimiento Técnico</option>
							@foreach ($tecnicos as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-1">
						<label for="addReq_Tecnico"></label>
						<button id="addReq_Tecnico" type="button" class="btn btn-info btn-xs"
							onclick="addRowToTable('tblReqTecnico', frmReserva.req_tecnico, 'Requerimiento Técnico', 'idReq', 'txtReq'); return false;">Agregar</button>
					</div>
				</div>
				<div class="form-group overflow-auto" style="height: 200px;">
					<table class="table table-sm" id ="tblReqTecnico" name ="tblReqTecnico">
						<thead class="thead-light"><tr><th scope="col" style="display:none;"></th><th colspan="2"><center>Requerimiento Técnico</center></th></tr></thead>
					</table>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="cristaleria">Cristalería y Loza</label>
						<select class ="form-control" id="cristaleria" name="cristaleria">
							<option value="">Seleccione Cristalería y Loza</option>
							@foreach ($cristalerias as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-1">
						<label for="addcristaleria"></label>
						<button id="addcristaleria" type="button" class="btn btn-info btn-xs"
							onclick="addRowToTable('tblcristaleria', frmReserva.cristaleria, 'Cristalería y Loza', 'idCristaleria', 'txtCristaleria'); return false;">Agregar</button>
					</div>
				</div>
				<div class="form-group overflow-auto" style="height: 200px;">
					<table class="table table-sm" id ="tblcristaleria" name ="tblcristaleria">
						<thead class="thead-light"><tr><th scope="col" style="display:none;"></th><th colspan="2"><center>Cristalería y Loza</center></th></tr></thead>
					</table>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="alimento">Alimentos y Bebidas</label>
						<select class ="form-control" id="alimento" name="alimento">
							<option value="">Seleccione Alimentos y Bebidas</option>
							@foreach ($alimentos as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group col-md-1">
						<label for="addalimento"></label>
						<button id="addalimento" type="button" class="btn btn-info btn-xs"
							onclick="addRowToTable('tblalimento', frmReserva.alimento, 'Alimentos y Bebidas', 'idalimento', 'txtalimento'); return false;">Agregar</button>
					</div>
				</div>
				<div class="form-group overflow-auto" style="height: 200px;">
					<table class="table table-sm" id ="tblalimento" name ="tblalimento">
						<thead class="thead-light"><tr><th scope="col" style="display:none;"></th><th colspan="2"><center>Alimentos y Bebidas</center></th></tr></thead>
					</table>
				</div>

				<div class="form-group">
					<label for="observaciones">Observaciones Adicionales</label>
					<textarea class ="form-control" id="observaciones" name="observaciones" onfocusout="remplazarEspeciales(this);" onkeypress="ValidaCaracter(event);"></textarea>
				</div>

				<button id="btnGuardar" type="button" class="btn btn-primary btn-lg btn-block" onclick="validateForm();">Agregar Reserva</button>
			</form>
		</div>
	</div>
</div>
@endsection