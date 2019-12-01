@extends('layout')

@section('title','Solicitud de Reserva')
@section('styles')
	<link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.css')}}">
    <link rel="stylesheet" href="{{asset('datePicker/css/bootstrap-datepicker3.standalone.css')}}">
@endsection
@section('scripts')
	<script src="{{asset('Jquery/jquery-3.4.1.min.js')}}" defer></script>
	<script src="{{asset('DatePicker/js/bootstrap-datepicker.js')}}" defer></script>
	<script src="{{asset('DatePicker/locales/bootstrap-datepicker.es.min.js')}}" defer></script>
	<script type="text/javascript" defer>
		var addMinistries;
		var minMaxPersons;
		var addRowToTable;
		var deleteRow;
		var validateForm;
		var getResourceDescripcion;
		var typeEventChg;

		deleteRow = function(index, tblID){
			var tbl = document.getElementById(tblID);
			tbl.deleteRow(index);
		}

		addRowToTable = function(tblID, objCombo, lblTxt, idRow, txtRow, cntID, numRow){
			var table = document.getElementById(tblID);
			var objCant = document.getElementById(cntID);
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
			var txtNum = document.createElement('input');
			txtNum.id = numRow + '[]';
			txtNum.setAttribute('type', 'text');
			txtNum.setAttribute('name', numRow + '[]');
			txtNum.setAttribute('value', objCant.value);
			txtNum.style.border = '1px solid #fff';
			txtNum.readOnly = 'true';
			cell1.style.display='none';
			cell1.style.width='0%';
			cell1.appendChild(txtNum);

			var cell2 = row.insertCell(2);
			var delBtn = document.createElement('input');
			delBtn.id = 'Del' + idRow + lastRow;
			delBtn.setAttribute('type', 'button');
			delBtn.setAttribute('name', 'Del' + idRow + lastRow);
			delBtn.className = 'btn btn-danger btn-xs';
			delBtn.setAttribute('value', 'X');
			delBtn.onclick = function () {
				deleteRow(this.parentNode.parentNode.rowIndex, tblID);
			};
			cell2.style.width='10%';
			cell2.appendChild(delBtn);

			var cell3 = row.insertCell(3);
			var txtNumLbl = document.createElement('label');
			txtNumLbl.innerText = objCant.value;
			cell3.style.width='10%';
			cell3.appendChild(txtNumLbl);

			var cell4 = row.insertCell(4);
			var txtReq = document.createElement('label');
			if (txtRow == 'txtalimento')
				txtReq.innerText = objCombo.options[objCombo.selectedIndex].text + ' (' + document.getElementById('descResource').value + ')';
			else
				txtReq.innerText = objCombo.options[objCombo.selectedIndex].text;
			cell4.style.width='80%';
			cell4.appendChild(txtReq);

			objCombo.selectedIndex = 0;
			objCant.value = 1;
		}

		getResourceDescripcion = function(id){
			if (id != ''){
				$.get('/reserva/getResourceDesc/' + id).done(
					function(response){
						document.getElementById('descResource').value = response;
					}
				)
			}
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
					document.getElementById('cantidad_persona').min=231; document.getElementById('cantidad_persona').max=800; document.getElementById('cantidad_persona').value=231;
					break;
			}
		}

		validateForm = function (){
			var blnContinue = true;
			document.getElementById('convention_id').classList.remove('is-invalid'); document.getElementById('tamano_reunion').classList.remove('is-invalid');
			document.getElementById('ministry_id').classList.remove('is-invalid'); document.getElementById('user_encargado_id').classList.remove('is-invalid');
			document.getElementById('costo_evento').classList.remove('is-invalid'); document.getElementById('nombre').classList.remove('is-invalid');
			document.getElementById('proposito').classList.remove('is-invalid'); document.getElementById('fecha_reunion').classList.remove('is-invalid');
			document.getElementById('hora_inicio').classList.remove('is-invalid'); document.getElementById('hora_fin').classList.remove('is-invalid');
			document.getElementById('reuniontype_id').classList.remove('is-invalid'); document.getElementById('cantidad_persona').classList.remove('is-invalid');
			document.getElementById('montaje_id').classList.remove('is-invalid'); document.getElementById('althorario').style.display = 'none';

			if (document.getElementById('nombre').value.trim() == ''){ document.getElementById('nombre').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('convention_id').selectedIndex == 0){ document.getElementById('convention_id').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('tamano_reunion').selectedIndex == 0){ document.getElementById('tamano_reunion').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('ministry_id').selectedIndex == 0 && document.getElementById('ministryDiv').style.display != 'none')
				{ document.getElementById('ministry_id').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('user_encargado_id').selectedIndex == 0){ document.getElementById('user_encargado_id').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('costo_evento').selectedIndex == 0  && document.getElementById('costo_eventoDiv').style.display != 'none')
				{ document.getElementById('costo_evento').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('proposito').value.trim() == ''){ document.getElementById('proposito').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('fecha_reunion').value.trim() == ''){ document.getElementById('fecha_reunion').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('hora_inicio').value.trim() == ''){ document.getElementById('hora_inicio').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('hora_fin').value.trim() == ''){ document.getElementById('hora_fin').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('hora_inicio').value.trim() != '' && document.getElementById('hora_fin').value.trim() != '') {
				var horaInicio = parseInt(document.getElementById('hora_inicio').value.trim().replace(":",""));
				var horaFin = parseInt(document.getElementById('hora_fin').value.trim().replace(":",""));

				if (horaInicio >= horaFin) {document.getElementById('althorario').style.display = 'block';  blnContinue=false; }
			}
			if (document.getElementById('reuniontype_id').selectedIndex == 0){ document.getElementById('reuniontype_id').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('cantidad_persona').value.trim() == ''){ document.getElementById('cantidad_persona').classList.add('is-invalid'); blnContinue = false;}
			if (document.getElementById('montaje_id').selectedIndex == 0){ document.getElementById('montaje_id').classList.add('is-invalid'); blnContinue = false;}

			if (blnContinue)
				frmReserva.submit();
			else
				alert('Favor Completar Información Requerida');
		}

		typeEventChg = function(type){
			var styleDiv = (type == 1) ? 'block' : 'none';

			document.getElementById('ministryDiv').style.display = styleDiv;
			document.getElementById('costo_eventoDiv').style.display = styleDiv;
			document.getElementById('musical_idDiv').style.display = styleDiv;
			document.getElementById('ministry_id').selectedIndex = 0;
			document.getElementById('costo_evento').selectedIndex = 0;
			document.getElementById('musical_id').selectedIndex = 0;
			document.getElementById('ministry_id').classList.remove('is-invalid');
			document.getElementById('costo_evento').classList.remove('is-invalid');
		}

		window.onload = function (){
			$('.datepicker').datepicker({
				format: "dd/mm/yyyy",
			    language: "es",
			    autoclose: true,
			    startDate: "+1d"
			}).on('changeDate', function(ev){
				document.getElementById('fecha_reunion').classList.remove('is-invalid');
			});
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
						<label for="nombre">Nombre de la reunión <strong>(*)</strong></label>
						<input class="form-control"	id="nombre" type="text" name="nombre" onfocusout="remplazarEspeciales(this);removeClassTXT(this);" onkeypress="ValidaCaracter(event);">
					</div>
					<div class="form-group col-md-2"></div>
					<div class="form-group col-md-3">
						<label for="typeEvent">Tipo de Evento <strong>(*)</strong></label>
						<br>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="typeEvent" id="typeEvent1" value="1" onchange="typeEventChg(1);" checked>
							<label class="form-check-label" for="typeEvent1">Interno</label>
						</div>
						<div class="form-check form-check-inline">
							<input class="form-check-input" type="radio" name="typeEvent" id="typeEvent2" value="2" onchange="typeEventChg(2);" >
							<label class="form-check-label" for="typeEvent2">Externo</label>
						</div>
					</div>
				</div>
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
								<option value="3">de 231 a 800 personas máximo</option>
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-4">
						<div id="ministryDiv">
							<label for="ministry_id">Ministerio <strong>(*)</strong></label>
							<select class ="form-control" name="ministry_id" id= "ministry_id" onchange="removeClassCmb(this);">
								<option value="">Seleccione Ministerio</option>
							</select>
						</div>
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
						<div id="costo_eventoDiv">
							<label for="costo_evento">Costo del Evento <strong>(*)</strong></label>
							<select class ="form-control" name="costo_evento" id= "costo_evento" onchange="removeClassCmb(this);">
								<option value="">Seleccione Costo del Evento</option>
								<option value="1">Presupuesto</option>
								<option value="2">Pago Directo</option>
							</select>
						</div>
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
						<input class="form-control" type="number" name="cantidad_persona" id="cantidad_persona" min="6" max="800" value="6" oninput="limitNumberMax(this);" onfocusout="limitNumberMin(this);">
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
						<div id="musical_idDiv">
							<label for="musical_id">Musical</label>
							<select class ="form-control" id="musical_id" name="musical_id">
								<option value="">Seleccione Música</option>
								@foreach ($musicas as $id => $nombre)
									<option value="{{ $id }}">{{ $nombre }}</option>
								@endforeach
							</select>
						</div>
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
					<div class="form-group col-md-2">
						<label for="cntReq_Tecnico">Cantidad</label>
						<input class="form-control" type="number" name="cntReq_Tecnico" id="cntReq_Tecnico" min="1" max="50" value="1" oninput="limitNumberMax(this);" onfocusout="limitNumberMin(this);">
					</div>
					<div class="form-group col-md-1">
						<label for="addReq_Tecnico"></label>
						<button id="addReq_Tecnico" type="button" class="btn btn-info btn-xs"
							onclick="addRowToTable('tblReqTecnico', frmReserva.req_tecnico, 'Requerimiento Técnico', 'idReq', 'txtReq', 'cntReq_Tecnico', 'numReq'); return false;">Agregar</button>
					</div>
				</div>
				<div class="form-group overflow-auto" style="height: 200px;">
					<table class="table table-sm table-bordered" id ="tblReqTecnico" name ="tblReqTecnico">
						<thead class="thead-light"><tr><th style="display:none;"></th><th style="display:none;"></th><th colspan="3"><center>Requerimiento Técnico</center></th></tr></thead>
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
					<div class="form-group col-md-2">
						<label for="cntcristaleria">Cantidad</label>
						<input class="form-control" type="number" name="cntcristaleria" id="cntcristaleria" min="1" max="50" value="1" oninput="limitNumberMax(this);" onfocusout="limitNumberMin(this);">
					</div>
					<div class="form-group col-md-1">
						<label for="addcristaleria"></label>
						<button id="addcristaleria" type="button" class="btn btn-info btn-xs"
							onclick="addRowToTable('tblcristaleria', frmReserva.cristaleria, 'Cristalería y Loza', 'idCristaleria', 'txtCristaleria', 'cntcristaleria', 'numcristaleria'); return false;">Agregar</button>
					</div>
				</div>
				<div class="form-group overflow-auto" style="height: 200px;">
					<table class="table table-sm table-bordered" id ="tblcristaleria" name ="tblcristaleria">
						<thead class="thead-light"><tr><th style="display:none;"></th><th style="display:none;"></th><th colspan="3"><center>Cristalería y Loza</center></th></tr></thead>
					</table>
				</div>

				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="alimento">Alimentos y Bebidas</label>
						<select class ="form-control" id="alimento" name="alimento" onchange="getResourceDescripcion(this.value);">
							<option value="">Seleccione Alimentos y Bebidas</option>
							@foreach ($alimentos as $id => $nombre)
								<option value="{{ $id }}">{{ $nombre }}</option>
							@endforeach
						</select>
						<input type="hidden" id="descResource">
					</div>
					<div class="form-group col-md-2">
						<label for="cntalimento">Cantidad</label>
						<input class="form-control" type="number" name="cntalimento" id="cntalimento" min="1" max="50" value="1" oninput="limitNumberMax(this);" onfocusout="limitNumberMin(this);">
					</div>
					<div class="form-group col-md-1">
						<label for="addalimento"></label>
						<button id="addalimento" type="button" class="btn btn-info btn-xs"
							onclick="addRowToTable('tblalimento', frmReserva.alimento, 'Alimentos y Bebidas', 'idalimento', 'txtalimento', 'cntalimento', 'numalimento'); return false;">Agregar</button>
					</div>
				</div>
				<div class="form-group overflow-auto" style="height: 200px;">
					<table class="table table-sm table-bordered" id ="tblalimento" name ="tblalimento">
						<thead class="thead-light"><tr><th style="width: 0%;display:none;"></th><th style="width: 0%;display:none;"></th><th style="width: 100%;" colspan="3"><center>Alimentos y Bebidas</center></th></tr></thead>
					</table>
				</div>

				<div class="form-group">
					<label for="observaciones">Observaciones Adicionales</label>
					<textarea class ="form-control" id="observaciones" name="observaciones" onfocusout="remplazarEspeciales(this);" onkeypress="ValidaCaracter(event);"></textarea>
				</div>

				<button id="btnGuardar" type="button" class="btn btn-primary btn-lg btn-block" onclick="validateForm();">Enviar Solicitud</button>
			</form>
		</div>
	</div>
</div>
@endsection