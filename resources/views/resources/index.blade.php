@extends('layout')

@section('title','Recursos')

@section('scripts')
	<script type="text/javascript" defer>

	</script>
@endsection
@section('content')
<div class="container">
	<div class="d-flex justify-content-between align-items-center mb-3">
		<h1 class="display-5 mb-0">Recursos</h1>
		@auth
			<a class="btn btn-primary" href="{{ route('resource.create') }}">Crear</a>
		@endauth
	</div>
	<form id="filter-form" action="{{ route('resource.index') }}" method="GET">
		<div class="form-row">

		</div>
		<div class="form-row">
			<div class="form-group col-md-4">
				<label for="tipo">Filtrar por</label>
				<select id="tipo" name="tipo" class="form-control">
					<option value="0" @if ("0" == $TipoFilter) selected="selected" @endif >Seleccione filtro</option>
					<option value="1" @if ("1" == $TipoFilter) selected="selected" @endif>Montaje</option>
					<option value="2" @if ("2" == $TipoFilter) selected="selected" @endif>Manteleria</option>
					<option value="3" @if ("3" == $TipoFilter) selected="selected" @endif>Requerimiento Técnico</option>
					<option value="4" @if ("4" == $TipoFilter) selected="selected" @endif>Musical</option>
					<option value="5" @if ("5" == $TipoFilter) selected="selected" @endif>Cristalería y Loza</option>
					<option value="6" @if ("6" == $TipoFilter) selected="selected" @endif>Alimentos y Bebidas<</option>
				</select>
			</div>
			<div class="form-group col-md-2">
				<label for="cntPage">Bloques De</label>
				<input class="form-control" type="number" name="cntPage" id="cntPage" min="1" max="50" value="{{ $Pag }}" oninput="limitNumberMax(this);" onfocusout="limitNumberMin(this);">
			</div>
			<div class="form-group col-md-2">
				<br>
				<a class="btn btn-info" href="#" onclick="event.preventDefault(); document.getElementById('filter-form').submit();">Filtrar</a>
			</div>
		</div>
	</form>
	<table class="table table-striped">
		<thead>
			<tr>
				<td>Tipo</td>
				<td>Nombre</td>
				<td>Acciones</td>
			</tr>
		</thead>
		<tbody>
			@forelse($resources as $resource)
				<tr>
					<td>{{ $resource->tipoNombre($resource)}}</td>
					<td>{{ $resource->nombre}}</td>
					<td>
						<a class="btn btn-info btn-xs" href="{{ route('resource.edit', $resource) }}">Editar</a>
						<form style="display:inline" method="POST" action="{{ route('resource.updateState', $resource) }}">
							@csrf @method('PATCH')
							<button class="btn btn-danger btn-xs" type="submit">Eliminar</button>
						</form>
					</td>
				</tr>
			@empty
			@endforelse
		</tbody>
	</table>
	@if (!request()->has('tipo'))
		{{ $resources->links() }}
	@else
		{{ $resources->appends(request()->query())->links() }}
	@endif
</div>
@endsection