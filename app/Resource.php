<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $guarded = [];
	protected $table = 'resources';

	public function tipoNombre(Resource $resource){
		$tipo = $resource->tipo;
		switch($tipo) {
			case 1:	$tipo = "Montaje";	break;
			case 2:	$tipo = "Manteleria";	break;
			case 3:	$tipo = "Requerimiento Técnico";	break;
			case 4:	$tipo = "Musical";	break;
			case 5:	$tipo = "Cristaleria y Loza";	break;
			case 6:	$tipo = "Alimentos y Bebidas";	break;
		}
        return $tipo;
    }
}
